<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumni Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            background: linear-gradient(135deg, #1a1a2e, #16213e);
        }

        .form-container {
            position: relative;
            z-index: 10;
            background: rgba(0, 50, 0, 0.9); /* Darkest greenish background */
            border-radius: 8px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5);
            padding: 2rem;
            max-width: 500px;
            margin: auto;
            transition: transform 0.3s ease;
        }

        .form-container:hover {
            transform: translateY(-5px);
        }

        input[type="text"],
        textarea {
            transition: border-color 0.3s ease, background-color 0.3s ease, box-shadow 0.3s ease;
            background-color: rgba(0, 70, 0, 0.8); /* Darkest greenish input background */
            color: white; /* Text color */
        }

        input[type="text"]:focus,
        textarea:focus {
            border-color: #3b82f6;
            background-color: rgba(0, 90, 0, 0.9); /* Lighter dark green on focus */
            box-shadow: 0 0 5px 2px rgba(56, 189, 248, 0.5), 0 0 10px 4px rgba(30, 58, 138, 0.5);
        }

        .btn-submit {
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #2563eb;
            transform: translateY(-2px);
        }

        .file-input {
            transition: background-color 0.3s ease;
        }

        .file-input:hover {
            background-color: #374151;
        }

        canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }
    </style>
</head>

<body>
    <canvas id="canvas"></canvas>
    <div class="form-container p-8">
        <h1 class="text-3xl font-semibold mb-6 text-center text-white">Alumni Registration</h1>
        <form id="registrationForm" action="submit.php" method="post" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-300">Name:</label>
                <input type="text" id="name" name="name" required
                    class="mt-1 block w-full border border-gray-600 rounded-md shadow-sm p-2 placeholder-gray-400">
            </div>
            <div class="mb-4">
                <label for="bio" class="block text-sm font-medium text-gray-300">Bio:</label>
                <textarea id="bio" name="bio" rows="3"
                    class="mt-1 block w-full border border-gray-600 rounded-md shadow-sm p-2 placeholder-gray-400"></textarea>
            </div>
            <div class="mb-4">
                <label for="educational_background" class="block text-sm font-medium text-gray-300">Educational Background:</label>
                <input type="text" id="educational_background" name="educational_background"
                    class="mt-1 block w-full border border-gray-600 rounded-md shadow-sm p-2 placeholder-gray-400">
            </div>
            <div class="mb-4">
                <label for="university_college" class="block text-sm font-medium text-gray-300">University/College:</label>
                <input type="text" id="university_college" name="university_college"
                    class="mt-1 block w-full border border-gray-600 rounded-md shadow-sm p-2 placeholder-gray-400">
            </div>
            <div class="mb-4">
                <label for="program_subject" class="block text-sm font-medium text-gray-300">Program/Subject:</label>
                <input type="text" id="program_subject" name="program_subject"
                    class="mt-1 block w-full border border-gray-600 rounded-md shadow-sm p-2 placeholder-gray-400">
            </div>
            <div class="mb-4">
                <label for="job" class="block text-sm font-medium text-gray-300">Job Title:</label>
                <input type="text" id="job" name="job"
                    class="mt-1 block w-full border border-gray-600 rounded-md shadow-sm p-2 placeholder-gray-400">
            </div>
            <div class="mb-4">
                <label for="position" class="block text-sm font-medium text-gray-300">Position:</label>
                <input type="text" id="position" name="position"
                    class="mt-1 block w-full border border-gray-600 rounded-md shadow-sm p-2 placeholder-gray-400">
            </div>
            <div class="mb-4">
                <label for="blood_group" class="block text-sm font-medium text-gray-300">Blood Group:</label>
                <input type="text" id="blood_group" name="blood_group"
                    class="mt-1 block w-full border border-gray-600 rounded-md shadow-sm p-2 placeholder-gray-400">
            </div>
            <div class="mb-4">
                <label for="facebook" class="block text-sm font-medium text-gray-300">Facebook Link:</label>
                <input type="text" id="facebook" name="facebook"
                    class="mt-1 block w-full border border-gray-600 rounded-md shadow-sm p-2 placeholder-gray-400">
            </div>
            <div class="mb-4">
                <label for="instagram" class="block text-sm font-medium text-gray-300">Instagram Link:</label>
                <input type="text" id="instagram" name="instagram"
                    class="mt-1 block w-full border border-gray-600 rounded-md shadow-sm p-2 placeholder-gray-400">
            </div>
            <div class="mb-4">
                <label for="linkedin" class="block text-sm font-medium text-gray-300">LinkedIn Link:</label>
                <input type="text" id="linkedin" name="linkedin"
                    class="mt-1 block w-full border border-gray-600 rounded-md shadow-sm p-2 placeholder-gray-400">
            </div>
            <div class="mb-4">
                <label for="github" class="block text-sm font-medium text-gray-300">GitHub Link:</label>
                <input type="text" id="github" name="github"
                    class="mt-1 block w-full border border-gray-600 rounded-md shadow-sm p-2 placeholder-gray-400">
            </div>
            <div class="mb-4">
                <label for="twitter" class="block text-sm font-medium text-gray-300">Twitter Link:</label>
                <input type="text" id="twitter" name="twitter"
                    class="mt-1 block w-full border border-gray-600 rounded-md shadow-sm p-2 placeholder-gray-400">
            </div>
            <div class="mb-6">
                <label for="profile_image" class="block text-sm font-medium text-gray-300">Profile Image:</label>
                <input type="file" id="profile_image" name="profile_image"
                    class="mt-1 block w-full text-gray-600 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-gray-600 file:text-gray-300 hover:file:bg-gray-700" accept="image/*">
            </div>
            <div class="mb-6">
                <label for="resume" class="block text-sm font-medium text-gray-300">Resume:</label>
                <input type="file" id="resume" name="resume"
                    class="mt-1 block w-full text-gray-600 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-gray-600 file:text-gray-300 hover:file:bg-gray-700">
            </div>
            <button type="submit"
                class="btn-submit w-full bg-blue-600 text-white font-semibold rounded-lg px-4 py-2 hover:bg-blue-700 transition duration-300">Submit</button>
        </form>
    </div>

    <script>
        const canvas = document.getElementById("canvas");
        const ctx = canvas.getContext("2d");

        let w, h, p;
        const imageInput = document.getElementById("profile_image");

        imageInput.addEventListener("change", function (event) {
            const file = event.target.files[0];
            if (file) {
                const img = new Image();
                const reader = new FileReader();

                reader.onload = function (e) {
                    img.src = e.target.result;
                };

                img.onload = function () {
                    // Set canvas size
                    w = img.width;
                    h = img.height;
                    canvas.width = w;
                    canvas.height = h;

                    // Draw the image on the canvas
                    ctx.drawImage(img, 0, 0, w, h);

                    // Compress the image and convert to data URL
                    p = 0.6; // Adjust this value for quality (0.6 means 60%)
                    const compressedDataURL = canvas.toDataURL("image/jpeg", p);
                    // Create a hidden input to send the compressed image data
                    const hiddenInput = document.createElement("input");
                    hiddenInput.type = "hidden";
                    hiddenInput.name = "compressed_image";
                    hiddenInput.value = compressedDataURL;
                    document.getElementById("registrationForm").appendChild(hiddenInput);
                };

                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>
