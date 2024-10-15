const logAlumniData = (searchText = "") => {
    fetch(`https://onukrom.xyz/alumnidata/api_alumni.php/alumni?name=${searchText}`)
        .then((res) => {
            if (!res.ok) {
                throw new Error(`HTTP error! Status: ${res.status}`);
            }
            return res.json();
        })
        .then((data) => {
            console.log(data); // Debugging log
            if (data.status && data.alumni) {
                // Filter alumni data to only include those with status 'approved'
                const approvedAlumni = data.alumni.filter(alumnus => alumnus.status === 'approved');
                displayCards(approvedAlumni);
            } else {
                console.error("No alumni data available or status is false");
                displayCards([]); // Clear display if no approved alumni
            }
        })
        .catch((error) => console.error("Fetch error:", error));
};

const addProtocol = (url) => {
    if (!url) return '#'; // Handle empty URLs
    return url.startsWith('http://') || url.startsWith('https://') ? url : `https://${url}`;
};

const displayCards = (alumni) => {
    const cardContainer = document.getElementById('card-container');
    const friendContainer = document.getElementById('friends-container');

    // Clear previous content in card container
    cardContainer.innerHTML = '';

    alumni.forEach((cards) => {
        const card = document.createElement('div');
        card.classList.add('w-full', 'md:w-1/2', 'p-2');

        // Construct the profile image URL
        const profileImageSrc = cards.profile_image === null || cards.profile_image === ''
            ? "alumnidata/uploads/profile_images/default-male-user-profile-icon.jpg"
            : `alumnidata/${cards.profile_image}`;  // Use the path directly from API

        card.innerHTML = `
            <a href="#" class="flex items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-[#F0F2F5]">
                <div class="bg-cover h-20 w-20 md:h-28 m-3 pl-3 md:w-28 rounded-full" style="background-image: url('${profileImageSrc}');"></div>                
                <div class="flex flex-col justify-between p-4 leading-normal">
                    <h2 class="mb-2 text-xl font-bold tracking-tight">${cards.name || "N/A"}</h2>
                    <h6 class="mb-3 font-normal">${cards.university || "N/A"}</h6>
                </div>
            </a>
        `;

        card.addEventListener('click', () => {
            console.log(cards.resume);
            // Clear and display the friend's profile in the friend container
            friendContainer.classList.add('hidden');
            friendContainer.innerHTML = `
                <div class="flex flex-col md:flex-row md:space-x-6 p-6 bg-white shadow-lg rounded-lg transition-shadow hover:shadow-xl relative">
                    <a href="${cards.resume ? `alumnidata/${cards.resume}` : '#'}" download="${cards.resume}">
                        <button class="absolute top-4 right-4 flex items-center px-3 py-2 text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors">
                            <i class="fas fa-file-alt mr-2"></i> Resume
                        </button>
                    </a>

                    <div class="bg-cover w-32 h-32 rounded-full border-4 border-gray-100" style="background-image: url('${profileImageSrc}');"></div>

                    <div class="flex flex-col justify-center w-[90%] md:w-[80%]">
                        <h2 class="text-2xl font-semibold mb-2 text-gray-800">${cards.name || "N/A"}</h2>
                        <div class="gap-4">
                            <div class="pb-8">
                                <p class="text-lg mb-1 text-black">${cards.bio || "N/A"}</p>
                            </div>
                            
                            <div class="flex">
                                <div>
                                    <p class="text-sm mb-1 text-gray-600"><strong>Educational Background:</strong> ${cards.educational_background || "N/A"}</p>
                                    <p class="text-sm mb-1 text-gray-600"><strong>University:</strong> ${cards.university || "N/A"}</p>
                                    <p class="text-sm mb-1 text-gray-600"><strong>Course:</strong> ${cards.program_subject || "N/A"}</p>
                                </div>
                                <div class="ml-20">
                                    <p class="text-sm mb-1 text-gray-600"><strong>Job:</strong> ${cards.job_title || "N/A"}</p>
                                    <p class="text-sm mb-1 text-gray-600"><strong>Position:</strong> ${cards.position || "N/A"}</p>
                                    <p class="text-sm mb-1 text-gray-600"><strong>Blood Group:</strong> ${cards.blood_group || "N/A"}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <h4 class="text-md font-bold mb-2 text-gray-800">Social Media</h4>
                            <div class="flex flex-wrap gap-3">
                                <a href="${addProtocol(cards.social_media?.facebook)}" target="_blank" class="flex items-center px-4 w-[47%] md:w-auto py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors mb-2">
                                    <i class="fab fa-facebook-f mr-2"></i> Facebook
                                </a>
                                <a href="${addProtocol(cards.social_media?.instagram)}" target="_blank" class="flex items-center w-[47%] md:w-auto px-4 py-2 text-white bg-pink-500 rounded-lg hover:bg-pink-600 transition-colors mb-2">
                                    <i class="fab fa-instagram mr-2"></i> Instagram
                                </a>
                                <a href="${addProtocol(cards.social_media?.linkedin)}" target="_blank" class="flex items-center px-4 py-2 w-[47%] md:w-auto text-white bg-blue-800 rounded-lg hover:bg-blue-900 transition-colors mb-2">
                                    <i class="fab fa-linkedin-in mr-2"></i> LinkedIn
                                </a>
                                <a href="${addProtocol(cards.social_media?.github)}" target="_blank" class="flex items-center px-4 w-[47%] md:w-auto py-2 text-white bg-gray-800 rounded-lg hover:bg-gray-700 transition-colors mb-2">
                                    <i class="fab fa-github mr-2"></i> GitHub
                                </a>
                                <a href="${addProtocol(cards.social_media?.twitter)}" target="_blank" class="flex items-center px-4 w-[47%] md:w-auto py-2 text-white bg-blue-400 rounded-lg hover:bg-blue-500 transition-colors mb-2">
                                    <i class="fab fa-twitter mr-2"></i> Twitter
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-5">
                    <h3 class="text-3xl font-bold">Other Alumni Friends</h3>
                </div>
            `;

            friendContainer.classList.remove('hidden');
        });

        cardContainer.appendChild(card);
    });
};

// Search event listener
document.getElementById("search-input").addEventListener("keyup", (e) => {
    logAlumniData(e.target.value);
});

// Initial call to load data (optional)
logAlumniData();
