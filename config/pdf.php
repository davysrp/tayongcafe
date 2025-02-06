<?php

/*return [
    'mode'                     => 'UTF-8',
    'format'                   => 'A4',
    'default_font_size'        => '12',
    'default_font'             => 'siemreap,sans-serif',
    'margin_left'              => 10,
    'margin_right'             => 10,
    'margin_top'               => 10,
    'margin_bottom'            => 10,
    'margin_header'            => 0,
    'margin_footer'            => 0,
    'orientation'              => 'P',
    'title'                    => 'Laravel mPDF',
    'subject'                  => '',
    'author'                   => '',
    'watermark'                => '',
    'show_watermark'           => false,
    'show_watermark_image'     => false,
    'watermark_font'           => 'sans-serif',
    'display_mode'             => 'fullpage',
    'watermark_text_alpha'     => 0.1,
    'watermark_image_path'     => '',
    'watermark_image_alpha'    => 0.2,
    'watermark_image_size'     => 'D',
    'watermark_image_position' => 'P',
    'custom_font_dir'          => base_path('resources/fonts/'),
    'custom_font_data'         => [
        'siemreap' => [
            'R' => 'KhmerOS_siemreap.ttf',
            'useOTL' => 0xFF, // required for Khmer
            'useKashida' => 75, // required for Khmer
        ],
    ],
    'auto_language_detection'  => true,
    'temp_dir'                 => rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR),
    'pdfa'                     => false,
    'pdfaauto'                 => false,
    'use_active_forms'         => false,
    'autoScriptToLang' => true,
    'autoLangToFont' => true,
];*/
return [
    'mode'                     => 'UTF-8',
    'format'                   => 'A4',
    'default_font_size'        => '12',
    'default_font'             => 'Nunito,sans-serif, battambang',
    'margin_left'              =>0,
    'margin_right'             =>0,
    'margin_top'               => 0,
    'margin_bottom'            => 0,
    'margin_header'            => 0,
    'margin_footer'            => 0,
    'orientation'              => 'P',
    'title'                    => 'Tangong Invoice',
    'subject'                  => '',
    'author'                   => '',
    'watermark'                => '',
    'show_watermark'           => false,
    'show_watermark_image'     => false,
    'watermark_font'           => 'sans-serif',
    'display_mode'             => 'fullpage',
    'watermark_text_alpha'     => 0.1,
    'watermark_image_path'     => '',
    'watermark_image_alpha'    => 0.2,
    'watermark_image_size'     => 'D',
    'watermark_image_position' => 'P',
    'auto_language_detection'  => false,
    'temp_dir'                 => rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR),
    'pdfa'                     => false,
    'pdfaauto'                 => false,
    'use_active_forms'         => false,
    'custom_font_dir' => public_path('fonts'),
    'custom_font_data' => [
        'battambang' => [
            'R'  => 'KhmerOS_battambang.ttf',   // regular font
            'useOTL' => 0xFF,   // required for complicated langs like Persian, Arabic and Chinese
            'useKashida' => 75, // required for complicated langs like Persian, Arabic and Chinese
        ],

    ]
];
