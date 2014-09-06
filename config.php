<?php return array(

    // An array of HTML tags to use
    'tags' => array('h2', 'h3', 'h4', 'h5'),

    // The meta tag to use for the 'mode' below
    'metatag' => 'toc',

    // Determine when to add the TOC to the page. Setting this to 'include' will
    // only include the TOC if it is explicitly set in the pages meta. See 
    // readme for more info.
    // values: include,exclude
    'mode' => 'exclude',

    // Element id prefix. When an element is not using the id attribute this
    // will be prefixed in in addition to the elements text value
    'prefix' => 'toc-',

    // Setting config information for PhileAdmin
    'info' => array(
        'author' => array(
            'name'     => 'Dan Gibbs',
            'homepage' => 'https://github.com/gibbs'
        ),
        'namespace' => 'Gibbs',
        'url'       => 'https://github.com/Gibbs/phileTableOfContents',
        'version'   => '0.0.9',
    ),
);
