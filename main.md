  <tbody>

                                                <tr>
                                                    <td style="text-align: center; vertical-align: middle;">
                                                        <div class="col-12">
                                                            <div class="d-flex align-items-flex-start">
                                                                <div class="col-12" id="ram_rom">
                                                                    <input type="text" class="form-control" id="inputPassword2" placeholder="Ram/Rom" name="phien_ban[]">
                                                                </div>
                                                            </div>
                                                    </td>
                                                    <td style="text-align: center; vertical-align: middle;">
                                                        <div class="col-12">
                                                            <div class="d-flex align-items-flex-start">
                                                                <div class="col-12" id="mau_sac">
                                                                    <input type="text" class="form-control" id="inputPassword2" placeholder="Màu sắc..." name="mau_sac[]">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="text-align: center; vertical-align: middle;">
                                                        <div class="col-12">
                                                            <div class="d-flex align-items-flex-start">
                                                                <div class="col-12" id="gia_nhap">

                                                                    <input type="text" class="form-control" id="inputPassword2" placeholder="Giá nhập..." name="gia_nhap[]">

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="text-align: center; vertical-align: middle;">
                                                        <div class="col-12">
                                                            <div class="d-flex align-items-flex-start">
                                                                <div class="col-12" id="gia_ban">
                                                                    <input type="text" class="form-control" id="inputPassword2" placeholder="Giá bán..." name="gia_ban[]">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="text-align: center; vertical-align: middle;">
                                                        <div class="col-12">
                                                            <div class="d-flex align-items-flex-start">
                                                                <div class="col-12" id="so_luong">
                                                                    <input type="text" class="form-control" id="inputPassword2" placeholder="Số lượng..." name="so_luong[]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                       Xoa
                                                    </td>
                                                <tr>


                                            </tbody>

                                            

        var btn_so_luong = document.getElementById("add_so_luong");


        var ram_rom = document.getElementById("ram_rom");
        var mau_sac = document.getElementById("mau_sac");
        var gia_ban = document.getElementById("gia_ban");
        var so_luong = document.getElementById("so_luong");
        var gia_nhap = document.getElementById("gia_nhap");

        let uniqueIdCounter = 0; // Bộ đếm để tạo ID duy nhất cho mỗi nhóm trường

        function addAllInputFields() {
            // Tăng ID duy nhất cho mỗi nhóm trường mới
            const uniqueId = uniqueIdCounter++;

            // Thêm các trường nhưng chỉ trường "so_luong" có nút "Xóa"
            addInputField(ram_rom, "Ram/Rom", "phien_ban[]", uniqueId, false); // Không có nút xóa
            addInputField(mau_sac, "Màu sắc...", "mau_sac[]", uniqueId, false); // Không có nút xóa
            addInputField(gia_nhap, "Giá nhập...", "gia_nhap[]", uniqueId, false); // Không có nút xóa
            addInputField(gia_ban, "Giá bán...", "gia_ban[]", uniqueId, false); // Không có nút xóa
            addInputField(so_luong, "Số lượng...", "so_luong[]", uniqueId, true); // Có nút xóa
        }

        function addInputField(container, placeholderText, inputName, uniqueId, hasDeleteButton) {
            // Tạo một dòng ngắt trước mỗi nhóm trường
            const lineBreak = document.createElement("br");

            // Tạo một div chứa trường nhập liệu và nút "Xóa" nếu cần
            var div_field = document.createElement("div");
            div_field.classList.add("d-flex", "justify-content-between", "align-items-center");
            div_field.setAttribute("data-id", uniqueId); // Gắn ID duy nhất cho div

            var input_field = document.createElement("input");
            input_field.type = "text";
            input_field.name = inputName;
            input_field.placeholder = placeholderText;
            input_field.classList.add("form-control", "w-75", "p-3");

            // Nếu có nút xóa, tạo và thêm vào
            if (hasDeleteButton) {
                const btn_xoa = document.createElement("div");
                btn_xoa.classList.add("btn", "btn-primary");
                btn_xoa.innerHTML = "Xóa";

                // Khi bấm "Xóa", sẽ xóa tất cả các trường có cùng ID duy nhất
                btn_xoa.addEventListener("click", () => {
                    // Tìm tất cả các trường có cùng ID duy nhất và xóa chúng
                    const fieldsToDelete = document.querySelectorAll(`[data-id="${uniqueId}"]`);
                    fieldsToDelete.forEach(field => {
                        field.previousSibling?.remove(); // Xóa dòng <br> trước đó, nếu có
                        field.remove();
                    });
                });

                div_field.append(btn_xoa); // Thêm nút xóa vào div_field
            }

            // Thêm dòng ngắt và trường nhập liệu vào container
            container.append(lineBreak);
            container.append(div_field);
            div_field.append(input_field);
        }

        // Gọi hàm addAllInputFields để thêm các ô khi bấm nút "Add"
        btn_so_luong.addEventListener("click", addAllInputFields);