const baseUrl = "..";
async function showAllLamaranKerjaApplied() {
    const response = await fetch(
        `${baseUrl}/controller/lamaran-kerja-controller.php?show_all_applied`

    );
    return response.json();
};

function doShowAllLamaranKerjaApplied() {
    const appliedLamaranDiv = document.querySelector(".lamaran-list");
    showAllLamaranKerjaApplied()
        .then((data) => {

            appliedLamaranDiv.innerHTML = `
                <div class="judul">
                    <h3>Daftar Lowongan Pekerjaan Terkirim</h3>
                </div>
                <br>
            `;
            if (data.length == 0) {
                appliedLamaranDiv.innerHTML += "<p>Daftar Lowongan Pekerjaan Kosong.</p>"
                appliedLamaranDiv.className += " empty";
            } else {
                data.forEach(row => {
                    appliedLamaranDiv.innerHTML += `

                    <div class="card">
                        <div class="card-info company-image-wrapper">
                            <img class="company-pic" src="../assets/images/company-profile/${row['company_image']}" alt="Company Logo">
                        </div>
                        <div class="card-info card-detail">
                            <h3>${row['lowongan_nama']}</h3>
                            <p><i class="fa fa-building" aria-hidden="true"></i> ${row['company_nama']}</p>
                            <p><i class="fa fa-map-marker" aria-hidden="true"></i> ${row['lowongan_lokasi']}</p>
                            <h3><span class="lamaran-status ${row['status'] == "DITERIMA" ? "bg-green" : row['status'] == "DITOLAK" ? "bg-red" : "bg-yellow"}">${row['status']}</span></h3>
                        </div>
                        <div class="card-info action">
                            <a href="#popup" onclick="showCatatanLamaran('${row['status']}', '${row['catatan']}')" class="detail-btn" title="Detail">Detail</a>
                        </div>
                    </div>
                    `;
                });
            }
        })
        .catch((err) => {
            alert(`Load Data Gagal.`);
        });
}


function showCatatanLamaran(status, catatan) {

    const popupDiv = document.querySelector("#popup");

    popupDiv.innerHTML += `
    <div class="popup">
        <div class="popup-info">
            <h3>Status: ${status}</h3>
            <a href = "#popup" onclick="cancelPopup()">Cancel</a>
        </div>
        <h3>Catatan dari Company:</h3>
        <textarea name="catatan" rows="10" disabled>${catatan}</textarea>
    </div>
        `;
}

function cancelPopup() {
    const popupDiv = document.querySelector("#popup");
    popupDiv.innerHTML = "";
}

document.addEventListener("DOMContentLoaded", () => {
    doShowAllLamaranKerjaApplied();
});