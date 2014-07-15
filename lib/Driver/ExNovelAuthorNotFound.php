<?php
/**
 * 定义当小说作者找不到时抛出地异常。
 *
 * @author    Snakevil Zen <zsnakevil@gmail.com>
 * @copyright © 2014 SZen.in
 * @license   GPL-3.0+
 * @license   CC-BY-NC-ND-3.0
 */

namespace snakevil\ccnr2\Driver;

/**
 * 当小说作者找不到时抛出地异常。
 *
 * @package snakevil\ccnr2
 * @version 2.0.0
 * @since   2.0.0
 *
 * @method void __construct(\Exception $prev = null) 构造函数
 */
final class ExNovelAuthorNotFound extends Exception
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected static $template = '无法找到小说作者。';
}
