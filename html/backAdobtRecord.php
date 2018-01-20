<?php
    ob_start();
    session_start();
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>查詢領養紀錄</title>
        <link rel="stylesheet" href="../css/backAdoptRecord.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>

    <body>
        <header>
            <nav>
                <ul>
                    <li>
                        <a href="backMemManage.html" title="會員帳號管理">會員帳號管理</a>
                    </li>
                    <li>
                        <a href="backEmpManage.html" title="員工帳號管理">員工帳號管理</a>
                    </li>
                    <li>
                        <a href="backHalfWay.html" title="中途之家審核">中途之家審核</a>
                    </li>
                    <li>
                        <a href="backReport.html" title="檢舉審核">檢舉審核</a>
                    </li>
                    <li>
                        <a href="backOrderlist.html" title="訂單管理">訂單管理</a>
                    </li>
                    <li>
                        <a href="backAdobtRecord.html" title="領養紀錄查詢">領養紀錄查詢</a>
                    </li>
                    <li>
                        <a href="backSaleRecord.html" title="銷售紀錄查詢">銷售紀錄查詢</a>
                    </li>
                    <li>
                        <a href="backProduct.html" title="寵物商品上下架">寵物商品上下架</a>
                    </li>
                </ul>
            </nav>
        </header>
        <div class="right">
            <div class="container container1">
                <div class="bigImg">
                    <img src="../images/back/catAdoptRecord.jpg" alt="">
                </div>
                <div class="adoptInfomation" id="adoptInfomation">
                    <select name="sort" id="adobtOrder">
                        <option value="1">領養日期從新到舊</option>
                        <option value="2">領養日期從舊到新</option>
                    </select>
                    <table id="adobtList">
                        <tr id="listTitle">
                            <th>喵小孩編號</th>
                            <th>領養者</th>
                            <th>領養時間</th>
                        </tr>
                    </table>
                    <div id="linkArea"></div>
                </div>
            </div>

        </div>
        <script>
            window.addEventListener('load', () => {

                function getData() {
                    let obj = JSON.parse(this.responseText);
                    let adobtList = document.getElementById('adobtList');
                    let fragment = document.createDocumentFragment();
                    let listLen = adobtList.childElementCount;
                    let linkArea = document.getElementById('linkArea');

                    while (linkArea.firstChild) {
                        linkArea.removeChild(linkArea.firstChild);
                    }
                    for (let i = listLen; i > 1; i--) {
                        adobtList.lastChild.remove();
                    }
                    for (const i of obj) {
                        let tr = document.createElement('tr');
                        let catNoTd = document.createElement('td');
                        let memIdTd = document.createElement('td');
                        let timeTd = document.createElement('td');
                        let catNo = document.createTextNode(i["喵編號"]);
                        let memId = document.createTextNode(i["領養者"]);
                        let time = document.createTextNode(i["領養時間"]);
                        catNoTd.appendChild(catNo);
                        memIdTd.appendChild(memId);
                        timeTd.appendChild(time);
                        tr.appendChild(catNoTd);
                        tr.appendChild(memIdTd);
                        tr.appendChild(timeTd);
                        fragment.appendChild(tr);
                    }
                    adobtList.appendChild(fragment);

                    ajax(showPages, `order=${order}&qty=${qty}&pages=true`);
                }

                function showPages() {
                    let count = this.responseText;
                    let linkArea = document.getElementById('linkArea');
                    let fragment = document.createDocumentFragment();
                    let pagesOne = document.createElement('a');
                    pagesOne.textContent = 1;
                    Object.assign(pagesOne, {
                        className: "defaultBtn"
                    });
                    pagesOne.addEventListener('click', changePages);
                    fragment.appendChild(pagesOne);
                    for (let i = 1; i < count; i++) {

                        if (i % limit == 0) {
                            let links = document.createElement('a');
                            links.textContent = (i / limit) + 1;
                            Object.assign(links, {
                                className: "defaultBtn"
                            });
                            links.addEventListener('click', changePages);
                            fragment.appendChild(links);
                        }

                    }
                    linkArea.appendChild(fragment);
                }

                function changePages() { //換頁面 ..第幾頁
                    qty = (parseInt(this.textContent) - 1);
                    let pagesQty = qty * limit;
                    ajax(getData, `order=${order}&qty=${qty}`);
                }

                function changeOrder() { //換排序 1:降冪 2: 升冪
                    order = this.value;
                    let adobtList = document.getElementById('adobtList');
                    let listLen = adobtList.childElementCount;
                    
                    ajax(getData, `order=${order}&qty=${qty}`);
                }

                function ajax(cb, dataInfo) {

                    let xhr = new XMLHttpRequest();
                    xhr.open('post', '../php/backAdobtRecord_s.php');
                    xhr.onload = cb;
                    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
                    xhr.send(dataInfo);

                }

                let selector = document.getElementById('adobtOrder');
                let qty = 0;
                let limit = 20;
                let order = 1;
                selector.addEventListener('change', changeOrder);
                ajax(getData, `order=${order}&qty=${qty}`);
            });
        </script>
    </body>

    </html>