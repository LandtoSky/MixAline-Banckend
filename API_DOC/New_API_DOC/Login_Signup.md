#login
-----------------------------------
	http://localhost:8082/login
	[POST]
	{
		"username": "admin",
		"password": "admin"
	}
	Result 
	{
	    "success": true,
	    "result": {
	        "id": 2,
	        "first_name": null,
	        "last_name": null,
	        "username": "admin",
	        "photo_url": null,
	        "phone_number": null,
	        "setting_push_notification": 1,
	        "timeline_count": 0,
	        "event_count": 0,
	        "created_at": "2017-10-17 03:42:07",
	        "updated_at": "2017-10-17 21:05:13",
	        "email": "admin@la.fr",
	        "token": "89ccdd8ba87c1042c88076e44dcb81ef"
	    }
	}
#Signup
------------------------------------------------------
	http://localhost:8082/register
	[POST]
	{
		"username": "admin",
		"password": "admin",
		"email": "admin@la.fr"
	}
	Result
	{
	    "success": true,
	    "result": {
	        "username": "user",
	        "email": "user@la.fr",
	        "token": "2d9db629690d2f1eab697ace7c71f2a1",
	        "updated_at": "2017-10-17 21:06:39",
	        "created_at": "2017-10-17 21:06:39",
	        "id": 3
	    }
	}
#Get all Users
---------------------------
	http://localhost:8082/api/v1/users
	[POST]
	{
		"user_id": "2",
		"token": "89ccdd8ba87c1042c88076e44dcb81ef"
	}
	Result 
	{
	    "success": true,
	    "result": [
	        {
	            "id": 2,
	            "first_name": null,
	            "last_name": null,
	            "username": "admin",
	            "photo_url": null,
	            "phone_number": null,
	            "setting_push_notification": 1,
	            "timeline_count": 2,
	            "event_count": 3,
	            "created_at": "2017-10-17 03:42:07",
	            "updated_at": "2017-10-17 21:23:58",
	            "email": "admin@la.fr",
	            "token": "89ccdd8ba87c1042c88076e44dcb81ef"
	        },
	        {
	            "id": 3,
	            "first_name": null,
	            "last_name": null,
	            "username": "user",
	            "photo_url": null,
	            "phone_number": null,
	            "setting_push_notification": 1,
	            "timeline_count": 0,
	            "event_count": 0,
	            "created_at": "2017-10-17 21:06:39",
	            "updated_at": "2017-10-17 21:06:39",
	            "email": "user@la.fr",
	            "token": "2d9db629690d2f1eab697ace7c71f2a1"
	        }
	    ]
	}	