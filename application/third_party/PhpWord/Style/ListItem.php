<?php
/**
 * This file is part of PHPWord - A pure PHP library for reading and writing
 * word processing documents.
 *
 * PHPWord is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/PHPOffice/PHPWord/contributors.
 *
 * @link        https://github.com/PHPOffice/PHPWord
 * @copyright   2010-2014 PHPWord contributors
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */

namespace PhpOffice\PhpWord\Style;

use PhpOffice\PhpWord\Style;

/**
 * List item style
 *
 * Before version 0.10.0, numbering style is defined statically with $listType.
 * After version 0.10.0, numbering style is defined by using Numbering and
 * recorded by $numStyle. $listStyle is maintained for backward compatility
 */
class ListItem extends AbstractStyle
{
    const TYPE_SQUARE_FILLED = 1;
    const TYPE_BULLET_FILLED = 3; // default
    const TYPE_BULLET_EMPTY = 5;
    const TYPE_NUMBER = 7;
    const TYPE_NUMBER_NESTED = 8;
    const TYPE_ALPHANUM = 9;
    const TYPE_PURE_NUMBER_NESTED_0 = 78;
    const TYPE_PURE_NUMBER_NESTED_1 = 79;
    const TYPE_PURE_NUMBER_NESTED_2 = 80;
    const TYPE_PURE_NUMBER_NESTED_3 = 81;
    const TYPE_PURE_NUMBER_NESTED_4 = 82;
    const TYPE_PURE_NUMBER_NESTED_5 = 83;
    const TYPE_PURE_NUMBER_NESTED_6 = 84;
    const TYPE_PURE_NUMBER_NESTED_7 = 85;
    const TYPE_PURE_NUMBER_NESTED_8 = 86;
    const TYPE_PURE_NUMBER_NESTED_9 = 87;
    const TYPE_PURE_NUMBER_NESTED_10 = 88;
    const TYPE_PURE_NUMBER_NESTED_11 = 89;
    const TYPE_PURE_NUMBER_NESTED_12 = 90;
    const TYPE_PURE_NUMBER_NESTED_13 = 91;
    const TYPE_PURE_NUMBER_NESTED_14 = 92;
    const TYPE_PURE_NUMBER_NESTED_15 = 93;
    const TYPE_PURE_NUMBER_NESTED_16 = 94;
    const TYPE_PURE_NUMBER_NESTED_17 = 95;
    const TYPE_PURE_NUMBER_NESTED_18 = 96;
    const TYPE_PURE_NUMBER_NESTED_19 = 97;
    const TYPE_PURE_NUMBER_NESTED_20 = 98;
    const TYPE_PURE_NUMBER_NESTED_21 = 99;
    const TYPE_PURE_NUMBER_NESTED_22 = 101;
    const TYPE_PURE_NUMBER_NESTED_23 = 102;
    const TYPE_PURE_NUMBER_NESTED_24 = 103;
    const TYPE_PURE_NUMBER_NESTED_25 = 104;
    const TYPE_PURE_NUMBER_NESTED_26 = 105;
    const TYPE_PURE_NUMBER_NESTED_27 = 106;
    const TYPE_PURE_NUMBER_NESTED_28 = 107;
    const TYPE_PURE_NUMBER_NESTED_29 = 108;
    const TYPE_PURE_NUMBER_NESTED_30 = 109;
    const TYPE_PURE_NUMBER_NESTED_31 = 110;
    const TYPE_PURE_NUMBER_NESTED_32 = 111;

    /**
     * Legacy list type
     *
     * @var integer
     */
    private $listType;

    /**
     * Numbering style name
     *
     * @var string
     * @since 0.10.0
     */
    private $numStyle;

    /**
     * Numbering definition instance ID
     *
     * @var integer
     * @since 0.10.0
     */
    private $numId;

    /**
     * Create new instance
     *
     * @param string $numStyle
     */
    public function __construct($numStyle = null)
    {
        if ($numStyle !== null) {
            $this->setNumStyle($numStyle);
        } else {
            $this->setListType();
        }
    }

    /**
     * Get List Type
     *
     * @return integer
     */
    public function getListType()
    {
        return $this->listType;
    }

    /**
     * Set legacy list type for version < 0.10.0
     *
     * @param integer $value
     * @return self
     */
    public function setListType($value = self::TYPE_BULLET_FILLED)
    {
        $enum = array(
            self::TYPE_SQUARE_FILLED, self::TYPE_BULLET_FILLED,
            self::TYPE_BULLET_EMPTY, self::TYPE_NUMBER,
            self::TYPE_NUMBER_NESTED, self::TYPE_ALPHANUM,
            self::TYPE_PURE_NUMBER_NESTED_0,
            self::TYPE_PURE_NUMBER_NESTED_1,
            self::TYPE_PURE_NUMBER_NESTED_2,
            self::TYPE_PURE_NUMBER_NESTED_3,
            self::TYPE_PURE_NUMBER_NESTED_4,
            self::TYPE_PURE_NUMBER_NESTED_5,
            self::TYPE_PURE_NUMBER_NESTED_6,
            self::TYPE_PURE_NUMBER_NESTED_7,
            self::TYPE_PURE_NUMBER_NESTED_8,
            self::TYPE_PURE_NUMBER_NESTED_9,
            self::TYPE_PURE_NUMBER_NESTED_10,
            self::TYPE_PURE_NUMBER_NESTED_11,
            self::TYPE_PURE_NUMBER_NESTED_12,
            self::TYPE_PURE_NUMBER_NESTED_13,
            self::TYPE_PURE_NUMBER_NESTED_14,
            self::TYPE_PURE_NUMBER_NESTED_15,
            self::TYPE_PURE_NUMBER_NESTED_16,
            self::TYPE_PURE_NUMBER_NESTED_17,
            self::TYPE_PURE_NUMBER_NESTED_18,
            self::TYPE_PURE_NUMBER_NESTED_19,
            self::TYPE_PURE_NUMBER_NESTED_20,
            self::TYPE_PURE_NUMBER_NESTED_21,
            self::TYPE_PURE_NUMBER_NESTED_22,
            self::TYPE_PURE_NUMBER_NESTED_23,
            self::TYPE_PURE_NUMBER_NESTED_24,
            self::TYPE_PURE_NUMBER_NESTED_25,
            self::TYPE_PURE_NUMBER_NESTED_26,
            self::TYPE_PURE_NUMBER_NESTED_27,
            self::TYPE_PURE_NUMBER_NESTED_28,
            self::TYPE_PURE_NUMBER_NESTED_29,
            self::TYPE_PURE_NUMBER_NESTED_30,
            self::TYPE_PURE_NUMBER_NESTED_31,
            self::TYPE_PURE_NUMBER_NESTED_32
        );
        $this->listType = $this->setEnumVal($value, $enum, $this->listType);
        $this->getListTypeStyle();

        return $this;
    }

    /**
     * Get numbering style name
     *
     * @return string
     */
    public function getNumStyle()
    {
        return $this->numStyle;
    }

    /**
     * Set numbering style name
     *
     * @param string $value
     * @return self
     */
    public function setNumStyle($value)
    {
        $this->numStyle = $value;
        $numStyleObject = Style::getStyle($this->numStyle);
        if ($numStyleObject instanceof Numbering) {
            $this->numId = $numStyleObject->getIndex();
            $numStyleObject->setNumId($this->numId);
        }

        return $this;
    }

    /**
     * Get numbering Id
     *
     * @return integer
     */
    public function getNumId()
    {
        return $this->numId;
    }

    /**
     * Get legacy numbering definition
     *
     * @return array
     * @since 0.10.0
     */
    private function getListTypeStyle()
    {
        // Check if legacy style already registered in global Style collection
        $numStyle = "PHPWordList{$this->listType}";
        if (Style::getStyle($numStyle) !== null) {
            $this->setNumStyle($numStyle);
            return;
        }

        // Property mapping for numbering level information
        $properties = array('start', 'format', 'text', 'align', 'tabPos', 'left', 'hanging', 'font', 'hint');

        $pure_numbered_nested_array = array(
            'type' => 'multilevel',
            'levels' => array(
                0 => '1, decimal, %1., left, 360, 720,      360, , ',
                1 => '1, decimal, %2., left, 792, 792,      360, , ',
                2 => '1, decimal, %3., left, 1224, 1224,    360, , ',
                3 => '1, decimal, %4., left, 1800, 1728,    360, , ',
                4 => '1, decimal, %5., left, 2520, 2232,    360, , ',
                5 => '1, decimal, %6., left, 2880, 2736,    360, , ',
                6 => '1, decimal, %7., left, 3600, 3240,    360, , ',
                7 => '1, decimal, %8., left, 3960, 3744,    360, , ',
                8 => '1, decimal, %9., left, 4680, 4320,    360, , ',
            ),
        );

        // Legacy level information
        $listTypeStyles = array(
            self::TYPE_SQUARE_FILLED => array(
                'type' => 'hybridMultilevel',
                'levels' => array(
                    0 => '1, bullet, , left, 720, 720, 360, Wingdings, default',
                    1 => '1, bullet, o, left, 1440, 1440, 360, Courier New, default',
                    2 => '1, bullet, , left, 2160, 2160, 360, Wingdings, default',
                    3 => '1, bullet, , left, 2880, 2880, 360, Symbol, default',
                    4 => '1, bullet, o, left, 3600, 3600, 360, Courier New, default',
                    5 => '1, bullet, , left, 4320, 4320, 360, Wingdings, default',
                    6 => '1, bullet, , left, 5040, 5040, 360, Symbol, default',
                    7 => '1, bullet, o, left, 5760, 5760, 360, Courier New, default',
                    8 => '1, bullet, , left, 6480, 6480, 360, Wingdings, default',
                ),
            ),
            self::TYPE_BULLET_FILLED => array(
                'type' => 'hybridMultilevel',
                'levels' => array(
                    0 => '1, bullet, , left, 720, 720, 360, Symbol, default',
                    1 => '1, bullet, o, left, 1440, 1440, 360, Courier New, default',
                    2 => '1, bullet, , left, 2160, 2160, 360, Wingdings, default',
                    3 => '1, bullet, , left, 2880, 2880, 360, Symbol, default',
                    4 => '1, bullet, o, left, 3600, 3600, 360, Courier New, default',
                    5 => '1, bullet, , left, 4320, 4320, 360, Wingdings, default',
                    6 => '1, bullet, , left, 5040, 5040, 360, Symbol, default',
                    7 => '1, bullet, o, left, 5760, 5760, 360, Courier New, default',
                    8 => '1, bullet, , left, 6480, 6480, 360, Wingdings, default',
                ),
            ),
            self::TYPE_BULLET_EMPTY => array(
                'type' => 'hybridMultilevel',
                'levels' => array(
                    0 => '1, bullet, o, left, 720, 720, 360, Courier New, default',
                    1 => '1, bullet, o, left, 1440, 1440, 360, Courier New, default',
                    2 => '1, bullet, , left, 2160, 2160, 360, Wingdings, default',
                    3 => '1, bullet, , left, 2880, 2880, 360, Symbol, default',
                    4 => '1, bullet, o, left, 3600, 3600, 360, Courier New, default',
                    5 => '1, bullet, , left, 4320, 4320, 360, Wingdings, default',
                    6 => '1, bullet, , left, 5040, 5040, 360, Symbol, default',
                    7 => '1, bullet, o, left, 5760, 5760, 360, Courier New, default',
                    8 => '1, bullet, , left, 6480, 6480, 360, Wingdings, default',
                ),
            ),
            self::TYPE_NUMBER => array(
                'type' => 'hybridMultilevel',
                'levels' => array(
                    0 => '1, decimal, %1., left, 720, 720, 360, , default',
                    1 => '1, bullet, o, left, 1440, 1440, 360, Courier New, default',
                    2 => '1, bullet, , left, 2160, 2160, 360, Wingdings, default',
                    3 => '1, bullet, , left, 2880, 2880, 360, Symbol, default',
                    4 => '1, bullet, o, left, 3600, 3600, 360, Courier New, default',
                    5 => '1, bullet, , left, 4320, 4320, 360, Wingdings, default',
                    6 => '1, bullet, , left, 5040, 5040, 360, Symbol, default',
                    7 => '1, bullet, o, left, 5760, 5760, 360, Courier New, default',
                    8 => '1, bullet, , left, 6480, 6480, 360, Wingdings, default',
                ),
            ),
            self::TYPE_NUMBER_NESTED => array(
                'type' => 'multilevel',
                'levels' => array(
                    0 => '1, decimal, %1., left, 360, 360, 360, , ',
                    1 => '1, decimal, %1.%2., left, 792, 792, 432, , ',
                    2 => '1, decimal, %1.%2.%3., left, 1224, 1224, 504, , ',
                    3 => '1, decimal, %1.%2.%3.%4., left, 1800, 1728, 648, , ',
                    4 => '1, decimal, %1.%2.%3.%4.%5., left, 2520, 2232, 792, , ',
                    5 => '1, decimal, %1.%2.%3.%4.%5.%6., left, 2880, 2736, 936, , ',
                    6 => '1, decimal, %1.%2.%3.%4.%5.%6.%7., left, 3600, 3240, 1080, , ',
                    7 => '1, decimal, %1.%2.%3.%4.%5.%6.%7.%8., left, 3960, 3744, 1224, , ',
                    8 => '1, decimal, %1.%2.%3.%4.%5.%6.%7.%8.%9., left, 4680, 4320, 1440, , ',
                ),
            ),
            self::TYPE_ALPHANUM => array(
                'type' => 'multilevel',
                'levels' => array(
                    0 => '1, decimal, %1., left, 720, 720, 360, , ',
                    1 => '1, lowerLetter, %2., left, 1440, 1440, 360, , ',
                    2 => '1, lowerRoman, %3., right, 2160, 2160, 180, , ',
                    3 => '1, decimal, %4., left, 2880, 2880, 360, , ',
                    4 => '1, lowerLetter, %5., left, 3600, 3600, 360, , ',
                    5 => '1, lowerRoman, %6., right, 4320, 4320, 180, , ',
                    6 => '1, decimal, %7., left, 5040, 5040, 360, , ',
                    7 => '1, lowerLetter, %8., left, 5760, 5760, 360, , ',
                    8 => '1, lowerRoman, %9., right, 6480, 6480, 180, , ',
                ),
            ),
            self::TYPE_PURE_NUMBER_NESTED_0     => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_1     => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_2     => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_3     => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_4     => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_5     => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_6     => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_7     => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_8     => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_9     => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_10    => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_11    => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_12    => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_13    => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_14    => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_15    => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_16    => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_17    => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_18    => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_19    => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_20    => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_21    => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_22    => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_23    => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_24    => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_25    => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_26    => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_27    => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_28    => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_29    => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_30    => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_31    => $pure_numbered_nested_array,
            self::TYPE_PURE_NUMBER_NESTED_32    => $pure_numbered_nested_array
        );

        // Populate style and register to global Style register
        $style = $listTypeStyles[$this->listType];
        foreach ($style['levels'] as $key => $value) {
            $level = array();
            $levelProperties = explode(', ', $value);
            $level['level'] = $key;
            for ($i = 0; $i < count($properties); $i++) {
                $property = $properties[$i];
                $level[$property] = $levelProperties[$i];
            }
            $style['levels'][$key] = $level;
        }
        Style::addNumberingStyle($numStyle, $style);
        $this->setNumStyle($numStyle);
    }
}
