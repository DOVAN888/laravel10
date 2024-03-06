<?php
return[
	'module' =>[
		[
			'title'=>'QL nhom thanh vien ',
			'icon'=>'fa fa-user',
			'name'=>['user'],
			'subModule'=>[
				[
				'title'=>'QL nhom thanh vien',
				'route'=>'user/catalogue/index'
			],
			[
				'title'=>'QL thanh vien',
				'route'=>'user/index',
				
			]

			]


		],
		[
			'title'=>'QL Bai Viet  ',
			'icon'=>'fa fa-file',
			'name'=>['post'],
			'subModule'=>[
				[
				'title'=>'QL nhom Bai viet',
				'route'=>'post/catalogue/index'
			],
			[
				'title'=>'QL bai viet',
				'route'=>'post/index'
			]

			]
		],
		[
			'title'=>'Languages',
			'icon'=>'fa fa-file',
			'name'=>['language'],
			'subModule'=>[
				[
				'title'=>'QL ngon ngu ',
				'route'=>'language/index'
			],

			

			]
		]
	],


];