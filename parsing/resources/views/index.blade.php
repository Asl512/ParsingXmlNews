<html>
<head>
</head>
<body>
@foreach($xml as $str)
    @foreach($str->item as $item)
        <p>title: {{$item->title}}</p>
        <p>link: {{$item->link}}</p>
        <p>description: {{$item->description}}</p>
        <p>date: {{$item->pubDate}}</p>
        @if($item->author)
            <p>autors: {{$item->author}}</p>
        @endif
        @if($item->enclosure)
            <p>image: {{$item->enclosure->attributes()->url}}</p>
            <br>
        @endif
    @endforeach
@endforeach
</body>
</html>