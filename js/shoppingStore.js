

var storage = localStorage;

function doFirst(){




	//幫每個add cart建事件聆聽功能
	var list = document.getElementsByClassName('addButton');
	//console.log(list.length);
	for(let i=0; i<list.length; i++){
		//console.log(list[i].id);	
		list[i].addEventListener('click', function(){
			//console.log(this);
			let teddyInfo = this.childNodes[1].value;
			//console.log(this.id);
			addItem(this.id,teddyInfo);

		});

	}

	
	
	if(storage['addItemList'] == null){
		storage['addItemList'] = ''; //storage.setItem('addItemList','');
	}

	let searchName = '';
    let searchBtn = document.getElementsByClassName('searchBtn')[0];
    searchBtn.addEventListener('click', ajaxData);

    //getData();

	
}


function ajaxData(e) {

	var searchName = document.getElementsByClassName('searchName')[0].value;
    
	if (searchName !== '') {
		//getData('searchName=' + searchName);
		var url = "../php/Cat_ShoppingStore_food.php?searchValue=" + searchName;
		
		var xhr = new XMLHttpRequest();
		
		xhr.onload = function(){
		
			if( xhr.status == 200 ){
				document.getElementById("pdContent").innerHTML = this.responseText;
			}else{
				alert(xhr.status);
			}
		
		}
		xhr.open("Get",url, true);
		xhr.send( null );
	} else if (searchName === '') {
		alert("請輸入喵喵商品關鍵字！");
	}
	
}

    



function addItem(itemId,itemValue){

	var image = document.createElement('img');
	image.src = itemValue.split('|')[1];
	//刪掉 '../images/productPic/' + 
	image.id = 'imageSelect';

	var title = document.createElement('span');
	title.innerText = itemValue.split('|')[0];

	var price = document.createElement('span');
	price.innerText = parseInt(itemValue.split('|')[2]);

	var newItem = document.getElementById('newItem');

	//存入storage
	if(storage[itemId]){
		alert('商品已在購物車裡囉！');
	}else{
		storage['addItemList'] += itemId + ', ';
		storage[itemId] = itemValue; //storage.setItem(itemId,itemValue);
	}

	//計算購買數量和小計
	var itemString = storage.getItem('addItemList');
	var items = itemString.substr(0,itemString.length-2).split(', ');
	//console.log(items);
	// console.log(items); //["A1001","A1002"]

	var subtotal = 0;
	for(var key in items){ //use items[key]
		//console.log(items[key]);
		var itemInfo = storage.getItem(items[key]);
		//console.log(itemInfo);
		var itemPrice = parseInt(itemInfo.split('|')[2]);

		subtotal += itemPrice;

	}

}

window.addEventListener('load', doFirst);





