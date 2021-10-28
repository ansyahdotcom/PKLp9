$(function() {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 1500
    });

    const flashData = $('.flash-data').data('flashdata');
    if(flashData == 'login'){
        Toast.fire({
            icon: 'success',
            title:'Anda Berhasil Login!',
        });
    } else if(flashData == 'logout') {
        Toast.fire({
            icon: 'success',
            title: 'Anda Berhasil Logout'
        });
    } else if(flashData == 'change_passwd') {
        Toast.fire({
            icon: 'success',
            title: 'Password berhasil diubah'
        });
    } else if(flashData == 'wrong_passwd') {
        Toast.fire({
            icon: 'error',
            title: 'Maaf Password Salah!'
        });
    } else if(flashData == 'belum_terdaftar') {
        Toast.fire({
            icon: 'error',
            title: 'Maaf User Belum Terdaftar!'
        });
    } else if (flashData == 'vote') {
        Toast.fire({
            icon: 'success',
            title: 'Anda Berhasil Memilih Satu Calon!',
        });
    }
});