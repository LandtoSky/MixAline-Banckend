#.1 Get All TimeLines
------------------------------
	http://localhost:8082/api/v1/lines?page=1
	[POST]
	{
		"user_id": "2",
		"token": "f2b9e25e5e32c2e6f2d424ea1af9a6e8"
	}
	Result
	{
	    "success": true,
	    "result": {
	        "current_page": 1,
	        "data": [
	            {
	                "id": 2,
	                "user_id": 2,
	                "title": "Airplane",
	                "start_date": "0000-00-00",
	                "end_date": "2034-12-23",
	                "color": "red",
	                "description": "An airplane or aeroplane (informally plane) is a powered, fixed-wing aircraft that is propelled forward by thrust from a jet engine or propeller",
	                "created_at": "2017-10-17 21:23:58",
	                "updated_at": "2017-10-17 21:23:58"
	            }
	        ],
	        "first_page_url": "http://localhost:8082/api/v1/lines?page=1",
	        "from": 1,
	        "last_page": 1,
	        "last_page_url": "http://localhost:8082/api/v1/lines?page=1",
	        "next_page_url": null,
	        "path": "http://localhost:8082/api/v1/lines",
	        "per_page": 10,
	        "prev_page_url": null,
	        "to": 1,
	        "total": 1
	    }
	}
#.2 Get TimeLine Detail
---------------------------------------------
	http://localhost:8082/api/v1/line/read/2  //----> 2 is TimeLine ID
	[POST]
	{
		"user_id": "2",
		"token": "f2b9e25e5e32c2e6f2d424ea1af9a6e8"
	}
	Result
	{
	    "success": true,
	    "result": {
	        "id": 3,
	        "user_id": 2,
	        "title": "Airplane",
	        "start_date": "0000-00-00",
	        "end_date": "2034-12-23",
	        "color": "red",
	        "description": "An airplane or aeroplane (informally plane) is a powered, fixed-wing aircraft that is propelled forward by thrust from a jet engine or propeller",
	        "created_at": "2017-10-19 13:57:45",
	        "updated_at": "2017-10-19 13:57:45",
	        "events": [
	            {
	                "id": 12,
	                "title": "Napoleon",
	                "start_date": "1970-01-01",
	                "end_date": "1970-01-01",
	                "description": "Napoléon Bonaparte (; 15 August 1769 – 5 May 1821) was a French military and political leader who rose to prominence during the French Revolution and led several successful campaigns during the French Revolutionary Wars",
	                "align": 0,
	                "visible": 1,
	                "created_at": "2017-10-19 13:54:50",
	                "updated_at": "2017-10-19 13:54:50",
	                "featured_image_url": "https://upload.wikimedia.org/wikipedia/commons/5/50/Jacques-Louis_David_-_The_Emperor_Napoleon_in_His_Study_at_the_Tuileries_-_Google_Art_Project.jpg",
	                "user_id": 2
	            },
	            {
	                "id": 13,
	                "title": "Napoleon",
	                "start_date": "1970-01-01",
	                "end_date": "1970-01-01",
	                "description": "Napoléon Bonaparte (; 15 August 1769 – 5 May 1821) was a French military and political leader who rose to prominence during the French Revolution and led several successful campaigns during the French Revolutionary Wars",
	                "align": 0,
	                "visible": 1,
	                "created_at": "2017-10-19 13:57:30",
	                "updated_at": "2017-10-19 13:57:30",
	                "featured_image_url": "https://upload.wikimedia.org/wikipedia/commons/5/50/Jacques-Louis_David_-_The_Emperor_Napoleon_in_His_Study_at_the_Tuileries_-_Google_Art_Project.jpg",
	                "user_id": 2
	            }
	        ]
	    }
	}
#.3 Get TimeLine & Event Count by User ID
-------------------------------------------
	http://localhost:8082/api/v1/count/2
	[POST]
	{
		"user_id": "2",
		"token": "89ccdd8ba87c1042c88076e44dcb81ef"
	}
	{
	    "success": true,
	    "result": {
	        "timeLineCount": 1,
	        "eventCount": 2
	    }
	}
#.4 Get TimeLines by UserId
-----------------------------------
	http://localhost:8082/api/v1/lines/show/2    //-- 2 is User ID
	[POST]
	{
		"user_id": "2",
		"token": "f2b9e25e5e32c2e6f2d424ea1af9a6e8"
	}
	Result
	{
	    "success": true,
	    "result": [
	        {
	            "id": 1,
	            "user_id": 2,
	            "title": "Airplane",
	            "start_date": "0000-00-00",
	            "end_date": "2034-12-23",
	            "color": "red",
	            "description": "An airplane or aeroplane (informally plane) is a powered, fixed-wing aircraft that is propelled forward by thrust from a jet engine or propeller",
	            "created_at": "2017-10-17 21:23:09",
	            "updated_at": "2017-10-17 21:23:09"
	        },
	        {
	            "id": 2,
	            "user_id": 2,
	            "title": "Airplane",
	            "start_date": "0000-00-00",
	            "end_date": "2034-12-23",
	            "color": "red",
	            "description": "An airplane or aeroplane (informally plane) is a powered, fixed-wing aircraft that is propelled forward by thrust from a jet engine or propeller",
	            "created_at": "2017-10-17 21:23:58",
	            "updated_at": "2017-10-17 21:23:58"
	        }
	    ]
	}
#.5 Get Events by UserId
-----------------------------------
	http://localhost:8082/api/v1/events/show/2?page=1   //-- 2 is User ID
	[POST]
	{
		"user_id": "2",
		"token": "f2b9e25e5e32c2e6f2d424ea1af9a6e8"
	}
	Result
	{
	    "success": true,
	    "result": {
	        "current_page": 1,
	        "data": [
	            {
	                "id": 10,
	                "timeline_id": 2,
	                "title": "Airplane",
	                "start_date": null,
	                "end_date": null,
	                "description": "An airplane or aeroplane (informally plane) is a powered, fixed-wing aircraft that is propelled forward by thrust from a jet engine or propeller",
	                "align": null,
	                "visible": 1,
	                "created_at": "2017-10-17 21:12:15",
	                "updated_at": "2017-10-17 21:12:15",
	                "img_src": null,
	                "img_caption": null,
	                "user_id": 2
	            },
	            {
	                "id": 11,
	                "timeline_id": 1,
	                "title": "Airplane",
	                "start_date": null,
	                "end_date": null,
	                "description": "An airplane or aeroplane (informally plane) is a powered, fixed-wing aircraft that is propelled forward by thrust from a jet engine or propeller",
	                "align": null,
	                "visible": 1,
	                "created_at": "2017-10-17 21:13:13",
	                "updated_at": "2017-10-17 21:13:13",
	                "img_src": null,
	                "img_caption": null,
	                "user_id": 2
	            }
	        ],
	        "first_page_url": "http://localhost:8082/api/v1/events/show/2?page=1",
	        "from": 1,
	        "last_page": 1,
	        "last_page_url": "http://localhost:8082/api/v1/events/show/2?page=1",
	        "next_page_url": null,
	        "path": "http://localhost:8082/api/v1/events/show/2",
	        "per_page": 10,
	        "prev_page_url": null,
	        "to": 2,
	        "total": 2
	    }
	}
