// #marked #onlydev
// $('input').attr('required', false);
// $('select').attr('required', false);

//script flash message
const title = $('.flash-data').data('title');
const icon = $('.flash-data').data('icon');
const message = $('.flash-data').data('message');
if (icon) {
    Swal.fire({
        title: title,
        html: message,
        icon: icon
    });
}

function jsonFlasher(json) {
    if (json.validation != undefined && json.validation?.length != 0) {
        let errorMessage = ``
        $.each(json.validation, function (index, message) {
            errorMessage += `${message} <br>`
        })

        Swal.fire({
            title: "Perhatian!",
            html: errorMessage,
            icon: "warning",
        });
        return false
    }

    Swal.fire({
        title: json.title,
        html: json.message,
        icon: json.icon,
    });
}

function sendFormData(url, formData, method = "POST") {
    $.ajax({
        url: url,
        method: method,
        dataType: "JSON",
        data: formData,
        processData: false,
        contentType: false,
        success: function (data, status) {
            console.log("success")
            console.log(data)

            if (data.validation != undefined && data.validation?.length != 0) {
                let popUpMessage = `Beberapa kolom perlu disesuaikan<br><ol>`

                $.each(data.validation, function (index, message) {
                    let newIndex = index.replace(".0", "")
                    $("#error-" + newIndex).html(message)
                    $(".error-" + newIndex).html(message)
                    if (data?.listingValidation) {
                        popUpMessage += `<li style="text-align:left;">${message}</li>`
                    }
                })

                $(".loader").hide()
                Swal.fire({
                    title: "Cek inputan anda!",
                    html: `${popUpMessage}</ol>`,
                    icon: "warning"
                });
                return false
            }

            if (data.message != undefined && data.message?.length != 0) {
                $(".loader").hide()
                Swal.fire({
                    title: "Cek inputan anda!",
                    html: `<center>${data?.message}</center>`,
                    icon: "warning"
                });
                return false
            }
            if (data.redirect) window.location.href = data.redirect
            $(".loader").hide()
        },
        error: function (xhr, desc, err) {
            $(".loader").hide()
            Swal.fire({
                title: "Terjadi kesalahan!",
                html: ``,
                icon: "error"
            });

            console.log("xhr")
            console.log(xhr)
            console.log(`desc => ${desc}`)
            console.log(`err => ${err}`)
        }
    });
}
