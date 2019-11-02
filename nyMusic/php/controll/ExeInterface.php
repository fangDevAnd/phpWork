<?php


/**
 * Interface ExeInterface
 *
 *
 * 这个接口的作用是定义了相同界面的不同行为
 *
 * 对于相同的界面，需要做到的事情比较多，所以通过这种功能方式来实现对操作的隔离
 *
 *
 *
 */

interface ExeInterface
{

    /**
     * 登录的访问接口
     */
    const EXE_LOGIN = "login";


    /**
     * 注册的访问接口
     */
    const EXE_REGISTER = "register";


    /**
     * 定义文件上传的访问接口
     */

    const EXE_UPLOAD = "upload";


    /**
     * 定义的是删除数据的接口
     */
    const  EXE_DEL = "del";

    /**
     * 定义的是添加数据的访问接口
     */
    const EXE_ADD = "add";


    /**
     * 定义的是更新的接口
     */
    const EXE_UPD = "update";

    /**
     * 定义的是查询的接口
     */
    const EXE_QUERY = "query";


    /**
     * 代表的是直接进行渲染
     */
    const EXE_ALL = "all";

    /**
     * 执行的是分类的动作
     */
    const  EXE_CLASSFY = "classfy";

    /**
     * 执行退出的操作
     */
    const EXE_EXIT_LOGIN = "exitLogin";
    /**
     * 执行播放
     */
    const EXE_PLAY = "play";

    /**
     * 下载的接口
     */
    const EXE_DOWNLOAD = "download";
    /**
     * 获得登录状态的接口
     */
    const EXE_LOGIN_STATUS = "loginStatus";

    /**
     *插入一条音乐的信息
     */
    const EXE_INSERT = "insert";
    /**
     * 获得服务器上面真实music的物理数据，并非是数据库的数据
     */
    const EXE_MUSIC_INFO = "musicInfo";
    /**
     * 删除真实的媒体数据
     */
    const EXE_DEL_REAL_MEDIA = "delRealMedia";
    /**
     *
     * 更新分类
     */
    const EXE_UPDATE_CLASSFY = "updateClassfy";

    /**
     * 添加新的分类
     */
    const EXE_ADD_CLASSFY = "addClassfy";
    /**
     * 删除分类
     */
    const EXE_DEL_CLASSFY = "delClassfy";
    /**
     * 音乐的详情信息
     *
     */
    const EXE_MUSIC_DETAIL = "musicDetail";
    /**
     * 更新音乐的信息
     */
    const EXE_UPDATE_MUSIC = "updateMusic";
    /**
     * 删除数据库的音乐数据
     */
    const EXE_DEL_MUSIC = "delMusic";


}