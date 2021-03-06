<?php
ob_start();
session_start();
isset($_SESSION['HALF_NO']) ? $_SESSION['HALF_NO'] = $_SESSION['HALF_NO'] : $_SESSION['HALF_NO'] = null;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>中途之家會員專區</title>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/533f4a82f0.js"></script>
    <script src="../js/signIn.js"></script>
    <link rel="icon" type="image/png" href="../images/logo_icon.png" />
    <link rel="stylesheet" href="../css/halfMem.css">
    <script src="../js/hb.js"></script>
</head>

<body onload="getData('halfMeminfo.php');">
<div class="likeBoxBack" id="likeBoxBack"></div>
    <div class="likeBox" id="likeBox"></div>
    <div class="signUpLightboxBlack"></div>
<div class="signUpLightbox" id="loginBox">
    <i class="fa fa-times cancel"></i>
    <div class="bgImg" id="bgImg"></div>
    <div id="formShape1" class="formShape formShape1">
        <div class="chioce">
            <button id="halfMember1">中途之家會員</button>
            <button id="member1" class="selected">一般會員</button>
        </div>
        <form action="../php/signIn2Member.php" class="signUpForm" id="signInForm" method="post" autocomplete="off">
            <br>
            <br>
            <br>
            <br>
            <label for="userId">會員帳號
                <br>
                <small>請輸入您的電子郵件</small>
            </label>
            <input type="email" id="userIdIn" name="memId" required>
            <br>
            <label for="userPsw">會員密碼
                <br>
                <small>請輸入6~10碼英數字</small>
            </label>
            <input type="password" id="userPswIn" name="memPsw" required>
            <br>
            <div class="chioce">
                <input type="submit" class="formBtn formSubmitBtn" value="登入">
            </div>
            <p class="signInUpPos">尚未成為會員嗎?
                <span id="signIn2Up">點此註冊</span>
            </p>
        </form>
    </div>
    <div id="formShape2" class="formShape formShape2">
        <div class="chioce">
            <button id="halfMember2">中途之家會員</button>
            <button id="member2" class="selected">一般會員</button>
        </div>
        <form action="../php/signUp2mem.php" method="post" id="signUpForm" enctype="multipart/form-data" autocomplete="off">
            <label for="userName">會員名稱
                <br>
                <small>不得多於8個中/英文字元</small>
            </label>
            <input type="text" name="userName" id="userName" placeholder="請輸入您的名稱" required>
            <br>
            <label for="userId">會員帳號
                <br>
                <small>請輸入您的電子郵件</small>
            </label>
            <input type="email" name="userId" id="userId" placeholder="請輸入您的電子郵件" required>
            <br>
            <label for="userPsw">會員密碼
                <br>
                <small>請輸入6~10碼英數字</small>
            </label>
            <input type="password" name="userPsw" id="userPsw" placeholder="請輸入您的密碼" required>
            <br>
            <label for="userTel">聯絡電話
                <br>
            </label>
            <input type="tel" name="userTel" id="userTel" placeholder="請輸入您的手機號碼" required>
            <br>
            <label for="userBirth">會員生日
                <br>
            </label>
            <input type="text" name="userBirth" id="userBirth" placeholder="ex:19900101" required>
            <br>
            <label for="userAddress">通訊地址
                <br>
            </label>
            <input type="text" name="userAddress" id="userAddress" placeholder="請輸入您的地址" required>
            <br>
            <div class="chioce">
                <label for="userPhoto" class="formBtn" id="userPhotoLabel" required>
                    點我上傳您的大頭貼
                </label>
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                <input type="file" name='image' id="userPhoto" placeholder="您可以上傳您的檔案" value="file">
                <input type="submit" id="loginBoxSubmit" class="formBtn formSubmitBtn" value="確認註冊">
            </div>
            <p class="signInUpPos">已經是會員了嗎?
                <span id="signUp2In">點此登入</span>
            </p>
        </form>
    </div>
</div>

<!-- header -->

<header>
    <div class="logo">
        <a href="../homepage.php">
            <h1>
                <img src="../images/logo_white.png" alt="尋喵啟事" title="回首頁">
            </h1>
        </a>
    </div>
    <nav>
        <ul>
            <li>
                <a href="catSearch.php">尋喵</a>
            </li>
            <li>
                <a href="halfway_house_search.php">中途之家</a>
            </li>
            <li>
                <a href="Cat_ShoppingStore.php" title="前往商城">商城</a>
            </li>
            <li>
                <a href="forum.php">討論區</a>
            </li>
            <li>
            <?php
if (!isset($_SESSION['MEM_NO']) && !isset($_SESSION['HALF_NO'])) {
    echo "<a href='#' class='login'>會員專區</a>";
} else {
    if (!isset($_SESSION['HALF_NO'])) {
        echo "<a href='./html/member.php'>會員專區</a>";
    } else {
        echo "<a href='./html/halfMem.php'>中途會員專區</a>";
    }
}
?>
            </li>
        </ul>
    </nav>
    <div class="icons">
            <a href="Cat_ShoppingStore_cart.php">
                <i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>
            </a>
            <?php
if (isset($_SESSION["MEM_NO"]) || isset($_SESSION["HALF_NO"])) {
    echo "<a href='../php/memberLogOut.php?memOut='true'' id='loginBtn'>
                            <i class='fa fa-sign-out fa-2x' aria-hidden='true'></i>
                            </a>";
} else {
    echo "<a href='#' class='login' id='loginBtn'>
                            <i class='fa fa-user-circle-o fa-2x' aria-hidden='true'></i>
                            </a>";
}
?>
            <?php
if (isset($_SESSION["MEM_NO"])) {
    echo "<a href='#' id='likeBoxBtn'>
                            <i class='fa fa-heart-o fa-2x' aria-hidden='true'></i>
                        </a>";
}
?>
    </div>
    <div class="hb">
        <div class="hamburger" id="hamburger-6">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </div>
    </div>
    <div class="hb">
            <div class="hamburger" id="hamburger-6">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </div>
        </div>
</header>

    <div class="right">
        <div class="bigImg"></div>
        <div class="container">
            <h2>我的中途之家會員專區</h2>
            <div class="leftselect">
                <div class="lefttitle"></div>
                <div class="leftlist">
                    <ul>
                        <li onclick="getData('halfMemInfo.php');" class="li">
                            <i class="fa fa-chevron-circle-right" aria-hidden="true"></i> 修改會員資料
                        </li>
                        <li onclick="getData('halfMemHalfway.php',callpic);" class="li">
                            <i class="fa fa-chevron-circle-right" aria-hidden="true"></i> 編輯中途之家資料
                        </li>
                        <li onclick="getData('halfMemCat.php',tempQQName);" class="li">
                            <i class="fa fa-chevron-circle-right" aria-hidden="true"></i> 編輯喵小孩資料
                        </li>
                        <li onclick="getData('halfMemOrderlist.php');" class="li">
                            <i class="fa fa-chevron-circle-right" aria-hidden="true"></i> 查詢訂單記錄
                        </li>
                        <li onclick="getData('halfMemAdoptRecord.php');" class="li">
                            <i class="fa fa-chevron-circle-right" aria-hidden="true"></i> 查詢領養紀錄
                        </li>
                        <li onclick="getData('halfMemAdopt.php');" class="li">
                            <i class="fa fa-chevron-circle-right" aria-hidden="true"></i> 審核領養案件
                        </li>
                    </ul>
                </div>
                <div class="leftbottom"></div>
            </div>

            <div class="smalllist">
                <ul>
                    <li onclick="getData('halfMeminfo.php');" class="li">
                        修改會員資料
                    </li>
                    <li onclick="getData('halfMemHalfway.php',callpic);" class="li">
                        編輯中途之家資料
                    </li>
                    <li onclick="getData('halfMemCat.php,tempQQName');" class="li">
                        編輯喵小孩資料
                    </li>
                    <li onclick="getData('halfMemOrderlist.php');" class="li">
                        查詢訂單記錄
                    </li>
                    <li onclick="getData('halfMemAdoptRecord.php');" class="li">
                        查詢領養紀錄
                    </li>
                    <li onclick="getData('halfMemAdopt.php');" class="li">
                        審核領養案件
                    </li>
                </ul>
            </div>

            <div class="content" id="content"></div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="follow">
                <div class="btns">
                    <span>follow us on</span>
                    <a href="#" class="btn facebook">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <a href="#" class="btn youtube">
                        <i class="fa fa-youtube"></i>
                    </a>
                    <a href="#" class="btn twitter">
                        <i class="fa fa-twitter"></i>
                    </a>
                    <a href="#" class="btn google">
                        <i class="fa fa-google"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>

<script>
    function getData(pagename,callback) {
        let xhr = new XMLHttpRequest();
        xhr.onload = function () {
            if (xhr.status == 200) {
                //modify here
                let content = document.getElementById('content');
                content.innerHTML = this.responseText;
                if(callback !== undefined){
                    callback();
                }
            } else {
                alert(xhr.status);
            }
        }
        let url = pagename;
        xhr.open("get", url, true);
        xhr.send(null);
    }

    function tempQQName() {
        let newEmp = document.getElementById('newEmp');
        newEmp.addEventListener('click', function () {
            let tr = document.getElementsByClassName('newEmpTR');
            if (tr[0].className.match('newEmpTROff')) {
                tr[0].className =
                    tr[0].className.replace('newEmpTROff', 'newblock');
                for (let i = 0; i < tr.length; i++) {
                    tr[i].className =
                        tr[i].className.replace('newEmpTROff', 'newEmpTROn');
                }
                let newEmp = document.getElementById('newEmp');
                newEmp.innerHTML = "取消新增喵小孩";
            } else {
                tr[0].className =
                    tr[0].className.replace('newblock', 'newEmpTROff');
                for (let i = 0; i < tr.length; i++) {
                    tr[i].className =
                        tr[i].className.replace('newEmpTROn', 'newEmpTROff');
                }
                let newEmp = document.getElementById('newEmp');
                newEmp.innerHTML = "新增喵小孩";
            }
        });

        let ensureBtn = document.getElementById('ensureBtn')
        ensureBtn.addEventListener('click', function () {
            confirm('您確定要新增嗎?')
        });

        function handleFileSelect(evt) {
            let files = evt.target.files;
            for (let i = 0, f; f = files[i]; i++) {
                let reader = new FileReader();
                reader.onload = (function(theFile) {
                    return function(e) {
                    let span = document.createElement('span');
                    span.innerHTML = ['<img class="filePic" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                    document.getElementById('picList').insertBefore(span, null);
                    };
                })(f);
                reader.readAsDataURL(f);
            }
        }
        document.getElementById('files').addEventListener('change', handleFileSelect, false);


        document.getElementById('resetBtn').addEventListener('click', function(){
            document.getElementById('picList').textContent='';
        });
        
    }

    function callpic() {
        function handleFileSelect(evt) {
            let files = evt.target.files;
            for (let i = 0, f; f = files[i]; i++) {
                let reader = new FileReader();
                reader.onload = (function(theFile) {
                    return function(e) {
                    let span = document.createElement('span');
                    span.innerHTML = ['<img class="filePic" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                    document.getElementById('picList').insertBefore(span, null);
                    };
                })(f);
                reader.readAsDataURL(f);
            }
        }
        document.getElementById('files').addEventListener('change', handleFileSelect, false);


        document.getElementById('resetBtn').addEventListener('click', function(){
            document.getElementById('picList').textContent='';
        });
    }
</script>
<script>
    let li = document.getElementsByClassName('li');
    for (let i = 0; i < li.length; i++) {
        li[i].addEventListener('click', function () {
            for (let i = 0; i < li.length; i++) {
                li[i].style.color = "#c2740f";
            }
            this.style.color = "#0f71c2";
        });
    }
</script>
<script>
    function add(data,action) {
        let xhr = new XMLHttpRequest();
        xhr.onload = function () {
            if (xhr.status == 200) {
                //modify here
                let odTable = document.getElementById('odTable');
                odTable.innerHTML = this.responseText;
                if(action != null){
                    action();
                }
            } else {
                alert(xhr.status);
            }
        }
        let url = data;
        xhr.open("get", url, true);
        xhr.send(null);
    }

    function catback() {
        let catbackPre = document.getElementById('catbackPre');
        catbackPre.addEventListener('click',function () {
            getData('halfMemCat.php',tempQQName);
        });
    }
</script>
<script src="../js/likeList.js"></script>

</html>