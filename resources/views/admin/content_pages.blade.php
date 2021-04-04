<div style="margin: 0px 50px">
@if($pages)
<table class="table table-hover table-striped">
    <thead>
        <tr>
            <th>№</th>
            <th>Імя</th>
            <th>Псевдонім</th>
            <th>Текст</th>
            <th>Дата створення</th>
            <th>Видалити</th>
        </tr>
    </thead>
    <tbody>
    @foreach($pages as $k=>$page)
        <tr>
            <td>{{$page->id}}</td>
            <td><a href="{{route('pagesEdit',['page'=>$page->id])}}" alt="{{$page->name}}">{{$page->name}}</a> </td>
            <td>{{$page->alias}}</td>
            <td>{{$page->text}}</td>
            <td>{{$page->created_at}}</td>
            <td>
                <form action="{{route('pagesEdit',['page'=>$page->id])}}" class="form-horizontal" method="post">
                    <input type="hidden" name="action" value="delete">
                    <input type="submit" value="Видалити" class="btn btn-danger">
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endif
    <a href="{{route('pageAdd')}}" >Додати нову сторінку</a>
</div>
