var app = app || {};

app = {
    url: '/students',
    init: function (){
        fetch(this.url)
            .then(response => response.json())
            .then(data => this.render(data));
    },
    render: function (data){
        let html = '';
        for (const student of data) {
            html += '<tr>';
            html += '<td>' + student.id + '</td>';
            html += '<td>' + student.name + '</td>';
            html += '<td>' + student.board + '</td>';
            html += '<td>' + student.grades.join(',') + '</td>';
            html += '<td>' + student.averageGrade + '</td>';
            html += '<td>' + student.isPass + '</td>';
            html += '<td><a target="_blank" href="' + app.url + '/' + student.id + '">Link</a></td>';
            html += '</tr>';
        }

        document.getElementById('students').innerHTML = html;
    }
};