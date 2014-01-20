<?php

namespace FDevs\CommonBundle\Twig\Extension;

/**
 * Common Twig extension
 *
 * @author Victor Melnik <melnikvictorl@gmail.com>
 */
class CommonExtension extends \Twig_Extension
{

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('reduce', array($this, 'reduceText')),
        );
    }

    /**
     * Reduce text by words
     *
     * @return string
     */
    public function reduceText($text, $maxLength = 150, $pad = '...')
    {
        $text = preg_replace('/&nbsp;/', ' ', $text);

        if (!$text || strlen($text) <= $maxLength) {
            return $text;
        }

        $reduced = strtok($text, ' ');
        $padLength = strlen($pad);

        while (($token = strtok(' ')) !== false) {
            $tmp = $reduced . ' ' . $token;
            if (strlen($tmp) + $padLength > $maxLength) {
                break;
            }
            $reduced = $tmp;
        }

        return $reduced . $pad;
    }

    /**
     * Returns extension name
     *
     * @return string
     */
    public function getName()
    {
        return 'fdevs.common';
    }

}
