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
            html += '<td><button onclick="app.addGrade('+student.id+')">Add</button></td>';
            html += '</tr>';
        }

        document.getElementById('students').innerHTML = html;
    },
    addGrade: function(id) {
        const grade = document.getElementById('new-grade').value;
        if (Number.isNaN(grade) || grade > 10 || grade < 1) {
            alert('Grade must be between 1 and 10!');
            return;
        }
        fetch("/students/"+id,
            {
                method: "POST",
                body: JSON.stringify({grade: grade})
            })
            .then(function(res){
                if (res.ok) {
                    location.reload();
                    return;
                }
                throw new Error('Maximum number of grades is 4');
            })
            .catch((error) => {
                alert(error)
            });
    }
};