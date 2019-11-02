/**
 * 定义类列的大小
 * @type {number}
 */
let columnSize = 4;


/**
 * 定义的是每个界面定义的显示music的数量
 * @type {number}
 */
let size = 20;

/**
 *
 * 将穿打底的music的数组解析成音乐的行的显示
 * @param musics
 */
function createMusicRow(musics) {


    var start = " <div class=\"itemRow\">";

    var end = "</div>";

    var obj = "";

    let row = "";

    for (let i = 0; i < musics.length; i++) {

        if (i % columnSize == 0) {
            row = "";//清空
            row = start;
        }

        row += createMusicItem(musics[i]);

        if (i == musics.length - 1 || i % columnSize == 3) {
            //代表的是最后一个,和每一行的最后一个
            row += end;

            obj += row;
        }
    }

    return obj;
}


/**
 * 创建单一的音乐列表
 * @param music
 */
function createMusicItem(music) {

    var item = "   <div class=\"itemView\">\n" +
        "                <div class=\"head\">\n" +
        "                    <div>\n" +
        "                        <div class=\"bg\">\n" +
        "                            <img src=\"../image/south.png\" alt=\"\">\n" +
        "                        </div>\n" +
        "                    </div>\n" +
        "                    <div class=\"right\">\n" +
        "                        <h4 class=\"title\">" + music.name + "</h4>\n" +
        "                        <div class=\"formatBox\">\n" +
        "                            <span class=\"format\">格式:mp3</span>\n" +
        "                            <span class=\"format td-unline\">详情</span>\n" +
        "                        </div>\n" +
        "                        <div class=\"formatBox\">\n" +
        "                            <div class=\"button\">\n" +
        "                                <span class=\"glyphicon glyphicon-save\">立即下载</span>\n" +
        "                            </div>\n" +
        "                            <div>\n" +
        "                                <span class=\"collectLogo\"></span>\n" +
        "                            </div>\n" +
        "                        </div>\n" +
        "                    </div>\n" +
        "                </div>\n" +
        "\n" +
        "                <div class=\"bottom\">\n" +
        "                    <span class=\"bofangLogo\"></span>\n" +
        "                    <span>00:00</span>\n" +
        "                    <span class=\"progressLogo\"></span>\n" +
        "                    <span>" + music.length + "</span>\n" +
        "                </div>\n" +
        "            </div>";
    return item;

}


/**
 * 创建异步不断刷新的界面结构
 */
function createMusicAsync(musics, getRows) {

    var start = " <div class=\"itemRow\">";

    var end = "</div>";


    let row = "";

    for (let i = 0; i < musics.length; i++) {
        if (i % columnSize == 0) {
            row = start;
        }
        row += createMusicItem(musics[i]);
        if (i == musics.length - 1 || i % columnSize == 3) {
            //代表的是最后一个,和每一行的最后一个
            row += end;
            getRows(row);
        }
    }
}


/**
 * 插入音乐的行信息
 * @param musics
 * @param parent
 */
function insertMusicRows(musics, parent) {
    // let data = createMusicRow(musics);
    /**
     * 先清空里面的数据
     */
    parent.empty();
    /**
     * 然后向里面添加
     */

    createMusicAsync(musics, function (row) {
        parent.append(row)
    })
}


/**
 * 更新登录的状态
 * @param loginStatus
 */
function updateLoginStatus(loginStatus) {

    $("#loginModel").empty();

    var noLogin = "<span class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#myModal\">登录</span>\n" +
        "            <a href=\"#\">\n" +
        "                <span data-toggle=\"modal\" data-target=\"#myModal1\">注册</span>\n" +
        "            </a>";

    var login = " <div style=\"position: relative\">\n" +
        "                <img src=\"../image/gedan2.jpg\" class=\"touxiang-small dropdown-toggle\" data-toggle=\"dropdown\">\n" +
        "                &nbsp; &nbsp;\n" +
        "                <a href=\"#\">\n" +
        "                    <span data-toggle=\"modal\" data-target=\"#myModal1\">退出登录</span>\n" +
        "                </a>\n" +
        "                <ul class=\"dropdown-menu\">\n" +
        "                    <li><a href=\"./manager.php\">管理</a></li>\n" +
        "                </ul>\n" +
        "            </div>";

    /**
     * 没有登录
     */
    if (loginStatus.account = -1) {

        $("#loginModel").append(noLogin);

    } else {
        $("#loginModel").append(login);
    }
}


function updateClassfy(classfys) {

    $("#classfyList").empty();

    var data = "";

    for (let i = 0; i < classfys.length; i++) {
        let item = "<span data-id='" + classfys[i].id + "' > " + classfys[i].name + " </span>";
        data += item;
    }

    $("#classfyList").append(data);
}


/**
 * 更新分页的信息
 * @param length
 */
function updateSplitPage(length) {


    /**
     * 设置开始使用省略的数量
     * 当分页数量大于3的时候就去执行省略
     * @type {number}
     */
    let slCount = 3;

    let obj = $("#splitPage_dis");

    let pageCount = length % size == 0 ? length / size : length / size + 1;

    pageCount = parseInt(pageCount);

    console.log(pageCount);

    let data = "";

    for (let i = 0; i < pageCount; i++) {
        let item = "";
        if (i < slCount) {
            item = " <span>" + (i + 1) + "</span>";
        } else if (i = slCount) {
            item = "<span>...</span>";
        } else if (i > slCount) {

            //打印最高三位，最低一位
            if (i == pageCount - 3 || i == pageCount - 2 || i == pageCount - 1) {
                item = " <span>" + i + "</span>";
            }
        }
        data += item;
    }

    obj.append(data);


}


/**
 * 音乐数据中是否存在下一页
 * @param currentIndex   当前选中的页面
 * @param length  当前的
 * @return 返回是否具有下一页
 */
function hasDownPage(currentPage, length) {

    let pageCount = length % size == 0 ? length / size : length / size + 1;

    pageCount = parseInt(pageCount)

    console.log(currentPage, pageCount)

    if (currentPage < pageCount - 1) {
        return true;
    }

    return false;
}








