document.addEventListener('DOMContentLoaded', () => {
    const today = new Date();
    M.Datepicker.init(document.getElementById('birthday'),{
        format: 'yyyy-mm-dd',
        defaultDate: new Date('1999-01-1'),
        maxDate: new Date(today.getFullYear(), today.getMonth(), today.getDate())
    });
    M.FormSelect.init(document.getElementById('jobId'));
});
