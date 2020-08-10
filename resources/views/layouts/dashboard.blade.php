@include('layouts.header')

@include('layouts.sidebar')

<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>@yield('judul')</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
        <div class="breadcrumb-item">@yield('judul')</div>
        <div class="breadcrumb-item">All @yield('judul')</div>
      </div>
    </div>

    @yield('content')
    <div class="section-body">
    </div>
  </section>
</div>

@include('layouts.footer')


<!-- Modal -->
<div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
  <div class="modal-dialog modal-default modal-dialog-centered modal-" role="document">
    <div class="modal-content bg-gradient-danger">

      <div class="modal-header">
        <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <div class="modal-body">

        <div class="py-3 text-center">
          <i class="ni ni-bell-55 ni-3x"></i>
          <h4 class="heading mt-4">Apakah kamu yakin ingin menghapus data ini?</h4>
        </div>

      </div>

      <div class="modal-footer">
        <form action="" method="post">
          {{ csrf_field() }}
          {{ method_field('delete') }}
          <p>
            <button type="submit" class="btn btn-danger btn-flat btn-sm menu-sidebar">Ok, Hapus</button>
            <button type="button" class="btn btn-primary btn-sm ml-auto" data-dismiss="modal">Close</button>
          </p>
        </form>
      </div>

    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
  <div class="modal-dialog modal-default modal-dialog-centered modal-" role="document">
    <div class="modal-content bg-gradient-danger">

      <div class="modal-header">
        <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <div class="modal-body">

        <div class="py-3 text-center">
          <i class="ni ni-bell-55 ni-3x"></i>
          <h4 class="heading mt-4">Lanjutkan ?</h4>
        </div>

      </div>

      <div class="modal-footer">
        <form action="" method="post">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          <p>
            <button type="submit" class="btn btn-danger btn-flat btn-sm menu-sidebar">Ok</button>
            <button type="button" class="btn btn-primary btn-sm ml-auto" data-dismiss="modal">Close</button>
          </p>
        </form>
      </div>

    </div>
  </div>
</div>

@yield('modal')



<!-- Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

<script>
  $(document).ready(function() {


    var flash = "{{ Session::has('sukses') }}";
    if (flash) {
      var pesan = "{{ Session::get('sukses') }}"
      swal("Sukses", pesan, "success");
    }

    var gagal = "{{ Session::has('gagal') }}";
    if (gagal) {
      var pesan = "{{ Session::get('gagal') }}"
      swal("Error", pesan, "error");
    }

    $('body').on('click', '.btn-hapus', function(e) {
      e.preventDefault();
      var url = $(this).attr('href');
      $('#modal-hapus').find('form').attr('action', url);
      $('#modal-hapus').modal();
    });

    $('body').on('click', '.btn-edit', function(e) {
      e.preventDefault();
      var url = $(this).attr('href');
      $('#modal-edit').find('form').attr('action', url);
      $('#modal-edit').modal();
    });

    $('.btn-refresh').click(function(e) {
      e.preventDefault();
      $('.preloader').fadeIn();
      location.reload();
    });

    $('#formTransaksi').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        type: "POST",
        url: "/transaksi",
        data: $('#formTransaksi').serialize(),
        success: function(response) {
          console.log(response);
          $('#transaksiModal').modal('hide')
          location.reload();
        },
        error: function(error) {
          console.log(error);
          alert('data not saved');
        }
      });
    });

    $('.btn-show').on('click', function(e) {

      $('#kode').text($(this).data('setoran'));
      $('#tanggal').text($(this).data('tanggal'));

      var subtotal = 0;
      var id = $(this).data('id');
      console.log(id);
      $.get('setoran/' + id, function(data) {
        $.each(data, function(key, value) {
          // console.log(value.alamat);
          $('<tr>').html("<td>" + value.alamat + "</td><td>" + value.barang.namabarang + "</td><td>" + value.jumlah_pembelian + "</td><td>" + value.total_harga + "</td>").appendTo('#records_table');
          subtotal += parseFloat(value.total_harga);
        });
        $('#subtotal').text(subtotal);

      });

      $('#showSetoraninvModal').modal('toggle');

    });

    $('#showSetoraninvModal').on('hidden.bs.modal', function() {

      $('#records_table').html('');
      $('#subtotal').text('');
    });

    $('.edit-btn').on('click', function() {

      $('#id').val($(this).data('id'));
      $('#alamat').val($(this).data('alamat'));
      $('#jumlah').val($(this).data('jumlah'));
      $('#idbarang').val($(this).data('nama')).change();
      // $('#myModal').modal('show');
      $('#editTransaksiModal').modal('show');

    });

    $('#editTransaksi').on('submit', function(e) {
      e.preventDefault();
      var transaksi_id = $('#id').val();
      console.log(transaksi_id);
      $.ajax({
        type: "POST",
        url: "/transaksi/" + transaksi_id,
        data: $('#editTransaksi').serialize(),
        success: function(response) {
          console.log(response);
          $('#editTransaksiModal').modal('hide')
          location.reload();
        },
        error: function(error) {
          console.log(error);
          alert('data not saved');
        }
      });


    });





  });
</script>