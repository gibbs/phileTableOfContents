<?php
/**
 * PhileCMS Table of Contents Plugin
 *
 * @package gibbs\phileTableOfContents
 * @author  Dan Gibbs <daniel.gibbs@gmail.com>
 * @license MIT
 */
namespace Phile\Plugin\Gibbs\phileTableOfContents;

class Plugin extends \Phile\Plugin\AbstractPlugin implements
    \Phile\Gateway\EventObserverInterface
{
    /**
     * Register plugin events via the constructor
     *
     * @return void
     */
    public function __construct()
    {
        \Phile\Event::registerEvent('template_engine_registered', $this);
    }

    /**
     * Listen to event triggers
     *
     * @param  string  $eventKey  Triggered event key
     * @param  array   $data      Array of event data
     * @return void    
     */
    public function on($eventKey, $data = null)
    {
        if($eventKey == 'template_engine_registered')
        {
            $toc = array();
            $tags = $this->settings['tags'];

            $page = $data['data']['current_page'];
            $meta = $page->getMeta()->getAll();

            // Determine if we should return a TOC or not
            $tag = $this->settings['metatag'];

            $metatag = isset($meta[$tag]) ? $meta[$tag] : null;

            // Determine if the TOC should be generated and returned
            if($this->settings['mode'] == 'include' AND $metatag != 'true')
                return;

            if($this->settings['mode'] == 'exclude' AND $metatag == 'false')
                return;

            $doc = new \DOMDocument();
            $doc->loadHTML($data['data']['content']);

            $prefix = $this->settings['prefix'];

            foreach($tags as $tag) {

                $elements = $doc->getElementsByTagName($tag);

                foreach($elements as $element) {
                    
                    if(!$element->getAttribute('id')) {
                        $id = $prefix . $this->friendlyName($element->nodeValue);
                        $element->setAttribute('id', $id);
                    }
                    else {
                        $id = $element->getAttribute('id');
                    }

                    $toc[] = array(
                        'title' => $element->nodeValue,
                        'hash'  => '#' . $id,
                    );
                }
            }

            // Set the template engine variable
            $data['data']['tableofcontents'] = $toc;

            // Set the modified markup
            $data['data']['content'] = $doc->saveHTML();
        }
    }

    protected function friendlyName($name)
    {
        return str_replace(' ', '-', $name);
    }
}
