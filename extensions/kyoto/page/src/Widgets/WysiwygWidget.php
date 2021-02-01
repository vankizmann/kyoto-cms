<?php

namespace Kyoto\Page\Widgets;

class WysiwygWidget extends WidgetElement
{
    /**
     * @var string
     */
    static $type = 'KyoWidgetWysiwyg';

    /**
     * Returns widget info to display
     *
     * @return array
     */
    public function info()
    {
        return [
            'title' => 'WYSIWYG Editor', 'description' => 'Insert text with a visual editor'
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
