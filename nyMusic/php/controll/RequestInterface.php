<?php


/**
 * Class RequestInterface
 *
 * 定义了访问的接口的类型
 */

interface RequestInterface
{


    /**
     * 首页的数据的访问接口
     */
    const ACTION_INDEX = "index";

    /**
     * 详细信息界面的访问接口
     */
    const ACTION_DETAIL = "detail";


    /**
     * 管理员的访问接口
     *
     * 这个接口的主要作用是用来控制文件上传，媒体数据管理等
     *
     *
     */
    const ACTION_MANAGER = "manager";








}