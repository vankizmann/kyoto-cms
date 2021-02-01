<?php

namespace Kyoto\Page\Widgets;

class HeadlineWidget extends WidgetElement
{
    /**
     * @var string
     */
    static $type = 'KyoWidgetHeadline';

    /**
     * Returns widget info to display
     *
     * @return array
     */
    public function info()
    {
        return [
            'title' => 'Headline', 'description' => 'Variable headline from h1 to h6'
        ];
    }

    /**
     * Does model matches widget type.
     *
     * @param array $data
     * @return array
     */
    public function prototype($data)
    {
        $defaultData = [
            'tag' => 'h1', 'title' => ''
        ];

        return array_merge($defaultData, $data);
    }

}
