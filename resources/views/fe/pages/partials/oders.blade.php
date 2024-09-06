@if($orders->isEmpty())
<h3>Không có đơn hàng nào</h3>
@else
@foreach ($orders as $i)
<h3 class="donhang" data-id="{{ $i->id }}">
    <a class="uk-link-heading" href="#">{{ '#' . $i->id }}
        <span class="uk-text-muted uk-text-small">{{ date('d/m/Y', strtotime($i->updated_at)) }}</span>
    </a>
    <button class="uk-button uk-button-default uk-button-small" onclick="toggleChiTiet('chitiet-{{ $i->id }}')">Chi tiết đơn hàng</button>
    @if ($type === 'donhangdxl')
    <button class="uk-button uk-button-danger uk-button-small" onclick="openHuyDonModal('{{ $i->id }}')">Hủy Đơn hàng</button>
    @endif
</h3>

<div id="chitiet-{{ $i->id }}" class="chitietdonhang" style="display: none;">
    <h4>Chi tiết sản phẩm</h4>
    <table class="uk-table uk-table-small uk-table-divider">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($i->chitietdonhangs as $detail)
            <tr>
                <td>{{ $detail->sanpham->ten }}</td>
                <td>{{ $detail->soluong }}</td>
                <td>{{ number_format($detail->gia, 0, ',', '.') }}đ</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endforeach
@endif
