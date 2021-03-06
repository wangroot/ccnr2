<?php
/**
 * 定义顶点站小说章节页内容分析组件。
 *
 * @author    Snakevil Zen <zsnakevil@gmail.com>
 * @copyright © 2017 SZen.in
 * @license   GPL-3.0+
 * @license   CC-BY-NC-ND-3.0
 */

namespace snakevil\ccnr2\Driver\x23us;

use snakevil\ccnr2;

/**
 * 飘天文学站小说章节页内容分析组件。
 *
 * @version 2.0.0
 *
 * @since   2.0.0
 */
class Chapter extends ccnr2\Utility\PageDriver
{
    /**
     * {@inheritdoc}
     *
     * @param string $clob 待分析地 HTML 代码
     *
     * @return mixed
     *
     * @throws ExChapterTitleNotFound      当章节标题找不到时
     * @throws ExChapterParagraphsNotFound 当章节段落列表找不到时
     */
    protected function parse($clob)
    {
        $clob = iconv('gb18030', 'utf-8//IGNORE', $clob);
        $a_ret = array();
        $s_regex = '@<h1>(.+)</h1>@Ui';
        $a_match = $this->estrstr($clob, $s_regex);
        if (!isset($a_match[1])) {
            throw new ccnr2\Driver\ExChapterTitleNotFound($this->ref, $s_regex);
        }
        $a_ret['title'] = $this->trim($a_match[1]);
        $s_regex = '@<dd id="contents">@';
        $a_match = $this->estrstr($clob, $s_regex);
        if (false === $a_match) {
            throw new ccnr2\Driver\ExChapterParagraphsNotFound($this->ref, $s_regex);
        }
        $s_regex = '~<div class="adhtml">~';
        $a_match = $this->estrstr($clob, $s_regex, true);
        if (false === $a_match) {
            throw new ccnr2\Driver\ExChapterParagraphsNotFound($this->ref, $s_regex);
        }
        $s_regex = '@(?:&nbsp;){4}(.+)(?:<br(?:| /)>|\n</dd>)@U';
        if (false === preg_match_all($s_regex, $clob, $a_match)) {
            throw new ccnr2\Driver\ExChapterParagraphsNotFound($this->ref, $s_regex);
        }
        $a_ret['paragraphs'] = array();
        for ($ii = 0, $jj = count($a_match[1]); $ii < $jj; ++$ii) {
            $a_match[1][$ii] = $this->trim($a_match[1][$ii]);
            if ('' != $a_match[1][$ii]) {
                $a_ret['paragraphs'][] = $a_match[1][$ii];
            }
        }

        return $a_ret;
    }
}
