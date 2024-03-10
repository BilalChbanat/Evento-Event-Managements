<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="images/favicon.png" rel="icon" />
    <title>General Invoice - PageCapture</title>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .ticket {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .ticket div {
            margin: 10px 0;
        }

        .ticket div label {
            display: block;
            color: #777;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .ticket div span {
            font-size: 16px;
            color: #666;
            line-height: 1.5;
        }

        .ticket .category span {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 14px;
        }

        .ticket .date span {
            font-weight: bold;
            color: #333;
        }
        .image{
            width: 90vw;
        }
    </style>
</head>

<body>
    
    <div class="ticket">
        <div class="image">
            <img src="{{asset( $event->image)}}" alt="">
        </div>
        <div>
            <label>Title:</label>
            <span>{{ $event->title }}</span>
        </div>
        <div>
            <label>Location:</label>
            <span>{{ $event->location }}</span>
        </div>
        <div class="category">
            <label>Refernce:</label>
            <span>{{ $reservation->reference }}</span>
        </div>
        <div class="date">
            <label>Date</label>
            <span>{{ $event->date }}</span>
        </div>
        <div>
            <label>Description:</label>
            <span>{{ $event->description }}</span>
        </div>
    </div>
</body>

</html>
