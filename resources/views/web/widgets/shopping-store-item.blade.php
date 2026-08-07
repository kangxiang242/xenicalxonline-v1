@foreach($data as $key=>$v)
<div class="form-radio">
    <input type="radio" {{ $key==0?"checked":"" }} id="store-{{ $v['shop_no'] }}" name="store_id" value="{{ $v['shop_no'] }}">
    <label class="radio-label" for="store-{{ $v['shop_no'] }}">
        <span class="ana"></span>
        <span class="text bg-711">{{ $v['shop_name'] }}<i>（{{ $v['shop_address'] }}）</i></span>
    </label>
</div>
@endforeach
