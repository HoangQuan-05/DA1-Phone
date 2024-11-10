var btn_ram = document.getElementById("add_ram");
var btn_mau_sac = document.getElementById("add_mau_sac");

var ram_rom = document.getElementById("ram_rom");
var mau_sac = document.getElementById("mau_sac");

btn_ram.addEventListener("click", () => {
  
  const lineBreak = document.createElement("br");
  var div_ram = document.createElement("div");
  div_ram.classList.add(
    "d-flex",
    "justify-content-between",
    "align-items-center"
  );

  const btn_xoa = document.createElement("div");
  btn_xoa.classList.add("btn", "btn-primary", `"ram_delete"`);
  btn_xoa.innerHTML = "Xoa";

  var input_ram = document.createElement("input");
  input_ram.type = "text";
  input_ram.name = "phien_ban[]";
  input_ram.placeholder = "Ram/Rom";
  input_ram.classList.add("form-control", "w-75", "p-3");

  ram_rom.append(lineBreak);
  div_ram.append(input_ram);
  div_ram.append(btn_xoa);
  ram_rom.append(div_ram);

  btn_xoa.addEventListener("click", () => {
    lineBreak.remove()
    div_ram.remove();
  });
});



btn_mau_sac.addEventListener("click", () => {
  
    const lineBreak = document.createElement("br");
    var div_ram = document.createElement("div");
    div_ram.classList.add(
      "d-flex",
      "justify-content-between",
      "align-items-center"
    );
  
    const btn_xoa = document.createElement("div");
    btn_xoa.classList.add("btn", "btn-primary");
    btn_xoa.innerHTML = "Xoa";
  
    var input_mau_sac = document.createElement("input");
    input_mau_sac.type = "text";
    input_mau_sac.name = "mau_sac[]";
    input_mau_sac.placeholder = "Mùa sắc";
    input_mau_sac.classList.add("form-control", "w-75", "p-3");
  
    mau_sac.append(lineBreak);
    div_ram.append(input_mau_sac);
    div_ram.append(btn_xoa);
    mau_sac.append(div_ram);
  
    btn_xoa.addEventListener("click", () => {
      lineBreak.remove()
      div_ram.remove();
    });
  });
  