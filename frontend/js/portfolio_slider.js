$(function(){
$("#elastic_grid_demo").elastic_grid({	
	'hoverDirection': true,
	'hoverDelay': 0,
	'hoverInverse': false,
	'expandingSpeed': 500,
	'expandingHeight': 500,
	'items' :
		[
			{
			'title' : 'بعض شاشات القائمة الرئيسية',
			'description'   : '',
			'thumbnail' : ['/frontend/img/portfolio/small/1.jpg', '/frontend/img/portfolio/small/2.jpg', '/frontend/img/portfolio/small/3.jpg', '/frontend/img/portfolio/small/4.jpg', '/frontend/img/portfolio/small/5.jpg'],
			'large' : ['/frontend/img/portfolio/large/1.jpg', '/frontend/img/portfolio/large/2.jpg', '/frontend/img/portfolio/large/3.jpg', '/frontend/img/portfolio/large/4.jpg', '/frontend/img/portfolio/large/5.jpg'],
			'button_list'   :
			[
			{ 'title':'Demo', 'url' : 'http://#' },
			{ 'title':'Download', 'url':'http://#'}
			],
			'tags'  : ['All']
			},

			{
			'title' : 'بعض شاشات شئون الموظفين',
			'description'   : 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.',
			'thumbnail' : ['/frontend/img/portfolio/small/6.jpg', '/frontend/img/portfolio/small/7.jpg', '/frontend/img/portfolio/small/8.jpg', '/frontend/img/portfolio/small/9.jpg', '/frontend/img/portfolio/small/10.jpg'],
			'large' : ['/frontend/img/portfolio/large/6.jpg', '/frontend/img/portfolio/large/7.jpg', '/frontend/img/portfolio/large/8.jpg', '/frontend/img/portfolio/large/9.jpg', '/frontend/img/portfolio/large/10.jpg'],
			'button_list'   :
			[
			{ 'title':'Demo', 'url' : 'http://#' },
			{ 'title':'Download', 'url':'http://#'}
			],
			'tags'  : ['All']
			},

			{
			'title' : 'بعض شاشات الفواتير',
			'description'   : 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.',
			'thumbnail' : ['/frontend/img/portfolio/small/11.jpg','/frontend/img/portfolio/small/12.jpg', '/frontend/img/portfolio/small/13.jpg', '/frontend/img/portfolio/small/14.jpg', '/frontend/img/portfolio/small/15.jpg'],
			'large' : ['/frontend/img/portfolio/large/11.jpg','/frontend/img/portfolio/large/12.jpg', '/frontend/img/portfolio/large/13.jpg', '/frontend/img/portfolio/large/14.jpg', '/frontend/img/portfolio/large/15.jpg'],
			'button_list'   :
			[
			{ 'title':'Demo', 'url' : 'http://#' },
			{ 'title':'Download', 'url':'http://#'}
			],
			'tags'  : ['All']
			},

			{
			'title' : 'بعض شاشات التقارير',
			'description'   : 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.',
			'thumbnail' : ['/frontend/img/portfolio/small/16.jpg', '/frontend/img/portfolio/small/17.jpg', '/frontend/img/portfolio/small/18.jpg', '/frontend/img/portfolio/small/19.jpg', '/frontend/img/portfolio/small/20.jpg'],
			'large' : ['/frontend/img/portfolio/large/16.jpg', '/frontend/img/portfolio/large/17.jpg', '/frontend/img/portfolio/large/18.jpg', '/frontend/img/portfolio/large/19.jpg', '/frontend/img/portfolio/large/20.jpg'],
			'button_list'   :
			[
			{ 'title':'Demo', 'url' : 'http://#' },
			{ 'title':'Download', 'url':'http://#'}
			],
			'tags'  : ['All']
			},


	 
		]
	});
});