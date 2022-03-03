function blockPage() {
    return $.blockUI({
        css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            color: '#fff'
        }
    });
}

function unBlockPage() {
    return $.unblockUI();
}

function toastAlert(message, title= 'Info', type = 'info', subTitle = null) {
    type = type.toLowerCase();
    var bgColor = 'bg-info'

    switch (type) {
        case 'success':
            bgColor = 'bg-success';
            break;
        case 'warning':
            bgColor = 'bg-warning';
            break;
        case 'danger':
            bgColor = 'bg-danger'
    }

    var body = `<div style="min-width: 250px; padding: 0.5rem; text-align: left; font-size: 1.2rem">
        ${message || ''}
    </div>`;

    $(document).Toasts('create', {
        title: title,
        subtitle: subTitle,
        autohide: true,
        delay: 3000,
        class: bgColor,
        body: body
    })
}

function refreshPage(delay = 3000) {
    setTimeout(() => {
        location.reload();
    }, delay);
}

function redirect(path, delay = 3000) {
    setTimeout(() => {
        location.href = path;
    }, delay);
}
