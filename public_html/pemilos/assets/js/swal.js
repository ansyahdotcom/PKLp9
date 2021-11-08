$(function() {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000
    });

    const flashData = $('.flash-data').data('flashdata');
    if(flashData == 'login'){
        Toast.fire({
            icon: 'success',
            title:'Anda berhasil login!',
        });
    } else if(flashData == 'logout') {
        Toast.fire({
            icon: 'success',
            title: 'Anda berhasil logout'
        });
    } else if(flashData == 'change_passwd') {
        Toast.fire({
            icon: 'success',
            title: 'Password berhasil diubah'
        });
    } else if(flashData == 'wrong_passwd') {
        Toast.fire({
            icon: 'error',
            title: 'Maaf password salah!'
        });
    } else if(flashData == 'wrong_oldpasswd') {
        Toast.fire({
            icon: 'error',
            title: 'Maaf Password Lama Salah!'
        });
    } else if(flashData == 'belum_terdaftar') {
        Toast.fire({
            icon: 'error',
            title: 'Maaf user belum terdaftar!'
        });
    } else if (flashData == 'vote') {
        Toast.fire({
            icon: 'success',
            title: 'Anda berhasil memilih satu calon!',
        });
    } else if (flashData == 'donevote') {
        Toast.fire({
            icon: 'success',
            title: 'Anda sudah memilih satu calon!',
        });
    } else if (flashData == 'reset') {
        Toast.fire({
            icon: 'success',
            title: 'Hasil voting berhasil dihapus',
        });
    } else if (flashData == 'save') {
        Toast.fire({
            icon: 'success',
            title: 'Data berhasil disimpan',
        });
    } else if (flashData == 'notsave') {
        Toast.fire({
            icon: 'error',
            title: 'Gagal menyimpan data',
        });
    } else if (flashData == 'edit') {
        Toast.fire({
            icon: 'success',
            title: 'Data berhasil diubah',
        });
    } else if (flashData == 'delete') {
        Toast.fire({
            icon: 'success',
            title: 'Data berhasil dihapus',
        });
    } else if (flashData == 'notdelete') {
        Toast.fire({
            icon: 'error',
            title: 'Gagal menghapus data',
        });
    } else if (flashData == 'nonactive') {
        Toast.fire({
            icon: 'success',
            title: 'Periode telah dinonaktifkan',
        });
    } else if (flashData == 'active') {
        Toast.fire({
            icon: 'success',
            title: 'Periode telah diaktifkan',
        });
    } else if (flashData == 'cek_buka') {
        Toast.fire({
            icon: 'error',
            title: 'Tidak ada kandidat. Harap isi data kandidat dahulu',
        });
    } else if (flashData == 'open') {
        Toast.fire({
            icon: 'info',
            title: 'Voting telah dibuka',
        });
    } else if (flashData == 'close') {
        Toast.fire({
            icon: 'info',
            title: 'Voting telah ditutup',
        });
    } else if (flashData == 'search') {
        Toast.fire({
            icon: 'info',
            title: 'Hasil pencarian ditemukan',
        });
    }
});