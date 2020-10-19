<?php
/**
 * Time validation rule
 *
 * @package GiantLeapLab.TimeWorked
 * @subpackage com_timeworked
 * @version 1.3.2
 * @date January 18, 2019
 * @author Giant Leap Lab. http://www.giantleaplab.com
 * @copyright Copyright (c) 2014-2019 Giant Leap Lab
 * @license GNU/GPL v3 http://www.gnu.org/licenses/gpl-3.0.html License code: 2QFSEH59TLTKR57KWKN2TJ574BNWOT4H
 */
defined('_JEXEC') or die;
jimport('joomla.form.formrule');

class JFormRuleTime extends JFormRule
{
  /**
   * {@inheritdoc}
   */

  public function test(SimpleXMLElement $element, $value, $group = null, JRegistry $input = null, JForm $form = null)
  {
    $regex = '/([1-9]|1[0-2])\s{1}:\s{1}[0-5][0-9]?\s{1}(PM|AM)/A';

    return !!preg_match($regex, $value);
  }

}
