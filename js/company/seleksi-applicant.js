const baseUrl = "..";

async function showAllLamaranKerjaApplied() {
    const response = await fetch(
        `${baseUrl}/controller/lamaran-kerja-controller.php?show_all_managed`

    );
    return response.json();
};

let result;

function doShowAllLamaranKerjaApplied() {
    const appliedLamaranDiv = document.querySelector(".applicant-list");
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
                    result = JSON.stringify(row);

                    appliedLamaranDiv.innerHTML += `
                        <div class="card">
                            <div class="card-info company-image-wrapper">
                                <img class="company-pic" src="../assets/images/applicant-profile/${row['applicant_image']}" alt="Company Logo">
                            </div>
                            <div class="card-info card-detail">
                                <h3>${row['applicant_nama']}</h3>
                                <p>Job Diapply: <a href="../lowongan/detail.php?id=${row['id_lowongan']}">${row['lowongan_nama']}<a></p>
                                <h3><span class="applicant-status ${row['status'] == "DITERIMA" ? "bg-green" : row['status'] == "DITOLAK" ? "bg-red" : "bg-yellow"}">${row['status']}</span></h3>
                            </div>
                            <div class="card-info action">
                                <a href="#popup" class="detail-btn" title="Detail">Detail</a>
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


function showPopupLamaran() {
    const popupDiv = document.querySelector("#popup");
    alert(JSON.parse(result));
    const data = '';
    popupDiv.innerHTML += `
    <div class="popup">
        <div class="popup-info">
            <h3>Status: ${data}</h3>
            <a href = "#popup" onclick="cancelPopup()">Cancel</a>
        </div>
        <h3>Catatan dari Company:</h3>
        <textarea name="catatan" rows="10" disabled>${data}</textarea>
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