<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluation Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
          .criteria-column {
            width: 30%; /* Đặt độ rộng cho cột Tiêu Chí */
        }
        .employee-column {
            width: 8.75%; /* 70% / 8 columns = 8.75% each */
            text-align: center;
            vertical-align: middle;
        }
        table {
            table-layout: fixed;
            width: 100%;
        }
        .employee-column .form-control {
            margin: 0 auto; /* Căn giữa theo chiều ngang */
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Đánh Giá Dịch Vụ</h2>
    <form action="#" method="POST">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th rowspan="2" class="text-center align-middle">Hạng Mục</th>
                    <th rowspan="2" class="text-center align-middle criteria-column">Tiêu Chí</th>
                    <th colspan="8" class="text-center">Họ và Tên</th>
                </tr>
                <tr>
                    <th class="employee-column">Lê Thị Phượng</th>
                    <th class="employee-column">Nguyễn Thị Thom</th>
                    <th class="employee-column">Hoàng Thị Yến</th>
                    <th class="employee-column">Lê Gia Hệ</th>
                    <th class="employee-column">Vương Thị Ánh</th>
                    <th class="employee-column">Trần Văn Hà</th>
                    <th class="employee-column">Ng.Vũ Nguyệt Hạ</th>
                    <th class="employee-column">Đào Như Quỳnh</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="7" class="text-center align-middle">Dịch vụ</td>
                    <td>1. Nhìn nhận một cách khách quan thì nhân viên có nỗ lực làm khách hàng hài lòng và cảm động thông qua việc cung cấp dịch vụ một cách thân thiện và sự quan tâm không?</td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                </tr>
                <tr>
                    <td>2. Có nhận thức được về khả năng dịch vụ của bản thân và nỗ lực bao nhiêu để nâng cao khả năng dịch vụ của bản thân?</td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                </tr>
                <tr>
                    <td>3. Khi gặp khách hàng có vấn đề, có quản lý cảm xúc tốt và nỗ lực để tìm hiểu tâm lý của khách hàng không?</td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                </tr>
                <tr>
                    <td>4. Để có thể giải thích một cách logic cho khách hàng, nhân viên có nhận biết được điểm yếu của bản thân mình để khắc phục bằng cách giải thích/ hướng dẫn cụ thể, thông qua đó làm khách hàng thoải mái và cảm động không? </td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                </tr>
                <tr>
                    <td>5. Có biết được tiêu chuẩn (khách hàng) không và từ đó có nhận biết được mục tiêu, phương hương mong muốn để nỗ lực để cải thiện không?</td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                </tr>
                <tr>
                    <td>6. Khi có vấn đề, có chủ động xem xét nhận biết nguyên nhân là gì và tích cực tìm phương án xử lý hiệu quả không?</td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                </tr>
                <tr>
                    <td>7. Có nỗ lực sắp xếp thông tin và ghi nhớ khuôn mặt khách hàng để có thể tiếp đón một cách thân tình hay không?</td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                    <td><input type="number" class="form-control" min="0" max="10"></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" class="text-center"><strong>Điểm Trung Bình Theo Hạng Mục</strong></td>
                    <td><input type="text" class="form-control text-center" disabled></td>
                    <td><input type="text" class="form-control text-center" disabled></td>
                    <td><input type="text" class="form-control text-center" disabled></td>
                    <td><input type="text" class="form-control text-center" disabled></td>
                    <td><input type="text" class="form-control text-center" disabled></td>
                    <td><input type="text" class="form-control text-center" disabled></td>
                    <td><input type="text" class="form-control text-center" disabled></td>
                    <td><input type="text" class="form-control text-center" disabled></td>
                </tr>
            </tfoot>
        </table>
        
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
