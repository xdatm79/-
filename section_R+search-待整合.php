    <section >
        <div class="bg-light" id="bgc">
            <div class="container">
                <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-light" data-bs-theme="light" id="ftc">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">
                            <i class="fa-solid fa-cake-candles"></i>
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="Home.html">首頁</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#s06">分類</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#s09">app下載</a>
                                </li>
                                <li class="nav-item dropdown ">
                                    <a class="nav-link dropdown-toggle text-danger fw-bold" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        會員功能
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item " href="myubook_R.html?id=XXX" id="link_control"
                                                style="display: none;">作者專區</a> </li>
                                        <li><a class="dropdown-item" href="member_one_center.html?id=XXX"
                                                id="link_control01" style="display: none;">會員中心</a></li>
                                        <li><a class="dropdown-item" href="mem_control_panel.html" id="link_control02"
                                                style="display: none;">後台會員管理</a></li>
                                        <li><a class="dropdown-item" href="20230207-maskmap.html" id="link_control03"
                                                style="display: none;">口罩地圖</a></li>
                                        <li><a class="dropdown-item" href="20230214-地圖作業.html" id="link_control04"
                                                style="display: none;">餐廳地圖</a></li>
                                        <li><a class="dropdown-item" href="vue_20230302_todos.html" id="link_control05"
                                                style="display: none;">todos</a></li>
                                        <li><a class="dropdown-item" href="controlPanel_chart.html" id="link_control06"
                                                style="display: none;">數據分析</a></li>
                                        <li><a class="dropdown-item" href="browse_book.html" id="link_control07"
                                                style="display: none;">讀者專區</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <!-- 背景紐 -->
                            <div class="form-check form-switch fs-4 mb-2 mb-lg-0">
                                <input type="checkbox" id="bgc_btn" name="bgc_btn " class="form-check-input bgc_btn"
                                    role="switch" " data-on=" warning" data-off="warning">
                                <label for=" bgc_btn" class="form-check-label"></label>
                            </div>
                            <!-- 搜索欄 --ok-->
                            <div class="form-check rounded-pill mb-3 mb-lg-0"
                                style="background-color: #d4d3d3; border: 0cm;height: 40px;width: 250px;">
                                <input type="text" name="search" id="search" placeholder="請輸入關鍵字" autocomplete="off"
                                    class="search mt-2"
                                    style="background-color: var(--mycolor16);border: 0cm;border-color: #d4d3d3;">
                                <a href="#s06" class="link-dark">
                                    <button type="submit" class="search btn rounded-pill"
                                        style="background-color:transparent;border: 0cm; ">
                                        <i class="fa-solid fa-magnifying-glass  mb-2"></i></button></a>
                            </div>


                            <!-- 登入 註冊 -->
                            <div class="mb-2 mb-lg-0">
                                <form class="d-flex me-2" role="search">
                                    <span class=" text-warning fw-400 fs-3 me-2" id="login_member"></span>
                                    <button class="btn btn-outline-secondary  me-1 rounded-pill" type="button"
                                        data-bs-toggle="modal" data-bs-target="#loginModal"
                                        id="s2_login_btn" >登入</button>
                                    <button class="btn btn-secondary rounded-pill " type="button" data-bs-toggle="modal"
                                        data-bs-target="#registerModal" id="s2_reg_btn">註冊</button>
                                    <button class="btn btn-danger me-2" type="button" id="logout_btn"
                                        style="display: none;">登出</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </section>

    <!-- 登入loginModal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">會員登入</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="login_username" class="form-label">帳號</label>
                        <input type="text" id="login_username" name="login_username" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="login_password" class="form-label">密碼</label>
                        <input type="password" id="login_password" name="login_password" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="me-auto" data-bs-toggle="modal" data-bs-target="#registerModal">沒有帳號, 註冊去!!!</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="login_btn" data-bs-dismiss="modal" >確認</button>
                </div>
            </div>
        </div>
    </div>
    <!-- 註冊registerModal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">會員註冊</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="fs-2">
                                會員守則
                            </div>
                            <div class="fs-5">1.市場過程背後開口手上記者溫柔事實告知我是資料網際經過，引導是我你們的經營你就精英避免上門活力投訴寶。</div>
                            <div class="fs-5">2.市場過程背後開口手上記者溫柔事實告知我是資料網際經過，引導是我你們的經營你就精英寶。</div>
                            <div class="fs-5">3.市場過程背後開口手上記者溫柔事實告知我是資料網際經過，引導是我你們的經營你就精英避免上門投訴寶。</div>
                            <div class="fs-5">4.市場過程背後開口手上記者溫柔我是資料網際經過，引導是我你們的經營你就精英避免上門活力投訴寶。</div>
                            <div class="form-check">
                                <input type="checkbox" id="mem_check01" name="mem_check01" class="form-check-input"
                                    value="true">
                                <label for="mem_check01" class="form-check-label">我會遵守</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="reg_username" class="form-label">帳號</label>
                                <input type="text" id="reg_username" name="reg_username" class="form-control"
                                    placeholder="帳號 1-8字!" required>
                                <div class="valid-feedback" id="reg_valid-feedback">帳號輸入正確!</div>
                                <div class="invalid-feedback" id="reg_invalid-feedback">帳號輸入錯誤!</div>
                            </div>
                            <div class="mb-3">
                                <label for="reg_password" class="form-label">密碼</label>
                                <input type="password" id="reg_password" name="reg_password" class="form-control"
                                    placeholder="密碼1-8字!" required>
                                <div class="form-text" id="err_reg_password"></div>
                                <div class="valid-feedback">密碼輸入正確!</div>
                                <div class="invalid-feedback">密碼輸入錯誤!</div>
                            </div>
                            <div class="mb-3">
                                <label for="reg_re_password" class="form-label">確認密碼</label>
                                <input type="password" id="reg_re_password" name="reg_re_password" class="form-control">
                                <div class="form-text" id="err_reg_re_password"></div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="email
                                1-8字!">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <a href="#" class="me-auto" data-bs-toggle="modal" data-bs-target="#loginModal">已經有帳號, 登入去!!!</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" id="reg_btn">確認</button>
                </div>
            </div>
        </div>
    </div>

    