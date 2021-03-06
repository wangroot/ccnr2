<?php
/**
 * 定义当章节段落列表找不到时抛出地异常。
 *
 * @author    Snakevil Zen <zsnakevil@gmail.com>
 * @copyright © 2014 SZen.in
 * @license   GPL-3.0+
 * @license   CC-BY-NC-ND-3.0
 */

namespace snakevil\ccnr2\Driver;

/**
 * 当章节段落列表找不到时抛出地异常。
 *
 * @package snakevil\ccnr2
 * @version 2.0.0
 * @since   2.0.0
 *
 * @method void __construct(string $uri, string $pattern, \Exception $prev = null) 构造函数
 */
final class ExChapterParagraphsNotFound extends Exception
{
    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected static $template = '页面“%uri$s”匹配“%pattern$s”段落列表失败。';

    /**
     * {@inheritdoc}
     *
     * @var string[]
     */
    protected static $contextSequence = array('uri', 'pattern');
}
