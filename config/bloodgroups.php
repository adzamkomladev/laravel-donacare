<?php

return [
    'A+' => [
        'receives' => [
            'A+', 'A-', 'O+', 'O-',
        ],
        'gives' => [
            'A+', 'AB+'
        ]
    ],
    'A-' => [
        'receives' => [
            'A-', 'O-',
        ],
        'gives' => [
            'A+', 'A-', 'AB-', 'AB+'
        ]
    ],
    'AB+' => [
        'receives' => [
            'A+', 'A-', 'AB-', 'AB+', 'O+', 'O-', 'B+', 'B-'
        ],
        'gives' => [
            'AB+'
        ]
    ],
    'AB-' => [
        'receives' => [
            'A-', 'AB-', 'O-', 'B-'
        ],
        'gives' => [
            'AB+', 'AB-'
        ]
    ],
    'B+' => [
        'receives' => [
            'B+', 'O+', 'O-', 'B-'
        ],
        'gives' => [
            'B+', 'AB+'
        ]
    ],
    'B-' => [
        'receives' => [
            'O-', 'B-'
        ],
        'gives' => [
            'B+', 'B-', 'AB+', 'AB-'
        ]
    ],
    'O+' => [
        'receives' => [
            'B+', 'O+', 'O-',
        ],
        'gives' => [
            'O+', 'A+', 'B+', 'AB+'
        ]
    ],
    'O-' => [
        'receives' => [
            'O-'
        ],
        'gives' => [
            'A+', 'A-', 'AB-', 'AB+', 'O+', 'O-', 'B+', 'B-'
        ]
    ],
];
