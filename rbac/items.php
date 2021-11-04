<?php

return [
    'importPractices' => [
        'type' => 2,
        'description' => 'Import Practices',
    ],
    'admin' => [
        'type' => 1,
        'children' => [
            'importPractices',
        ],
    ],
];
