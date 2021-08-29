<?php

/**
 * This file is part of the Krystal Framework
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Krystal\Widget\Bootstrap5\Accordion;

use Krystal\Form\NodeElement;

final class AccordionMaker
{
    /**
     * Accordion items
     * 
     * @var array
     */
    private $items = array();

    /**
     * Accordion options
     * 
     * @var array
     */
    private $options = array();
    
    /**
     * State initialization
     * 
     * @param array $items
     * @param array $options
     * @return void
     */
    public function __construct(array $items, array $options = array())
    {
        $this->items = $items;
        $this->options = $options;
    }

    /**
     * Render accordion
     * 
     * @return string
     */
    public function render()
    {
        $id = sprintf('accordion-%s', time());
        $accordion = $this->createItems($id, $this->items);

        return $accordion->render();
    }

    /**
     * Create items
     * 
     * @param string $parent Id of parent container
     * @param array $items
     * @return array
     */
    private function createItems($parent, array $items)
    {
        $wrapper = new NodeElement();
        $wrapper->openTag('div')
                ->addAttributes(array(
                    'class' => 'accordion',
                    'id' => $parent
                ));

        foreach ($items as $index => $item) {
            $child = $this->createItem($parent, $index, $item['header'], $item['body']);
            $wrapper->appendChild($child);
        }

        $wrapper->closeTag();

        return $wrapper;
    }

    /**
     * Create item
     * 
     * @param string $parent Id of parent container
     * @param int $index Current index
     * @param string $header
     * @param string $content
     * @return \Krystal\Form\NodeElement
     */
    private function createItem($parent, $index, $header, $content)
    {
        // Whether item is expanded
        $expanded = $index == 0;

        $button = new NodeElement();
        $button->openTag('button')
               ->addAttributes(array(
                'class' => $expanded ? 'accordion-button' : 'accordion-button collapsed',
                'type' => 'button',
                'data-bs-toggle' => 'collapse',
                'data-bs-target' => sprintf('#collapse-%s', $index),
                'aria-expanded' => $expanded ? 'true' : 'false',
                'aria-controls' => sprintf('collapse-%s', $index)
               ))
               ->setText($header)
               ->closeTag();

        $h2 = new NodeElement();
        $h2->openTag('h2')
           ->addAttributes(array(
            'class' => 'accordion-header',
            'id' => sprintf('heading-%s', $index)
           ));

        $h2->appendChild($button)
           ->closeTag();

        $body = new NodeElement();
        $body->openTag('div')
             ->addAttribute('class', 'accordion-body')
             ->finalize()
             ->setText($content)
             ->closeTag();

        $collapse = new NodeElement();
        $collapse->openTag('div')
                 ->addAttributes(array(
                    'id' => sprintf('collapse-%s', $index),
                    'class' => $expanded ? 'accordion-collapse collapse show' : 'accordion-collapse collapse',
                    'aria-labelledby' => sprintf('heading-%s', $index),
                    'data-bs-parent' => '#' . $parent
                 ))
                 ->appendChild($body)
                 ->closeTag();

        $item = new NodeElement();
        $item->openTag('div')
             ->addAttribute('class', 'accordion-item')
             ->finalize()
             ->appendChildren(array($h2, $collapse))
             ->closeTag();

        return $item;
    }
}
