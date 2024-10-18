<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body>
    <div class="h-screen flex justify-center items-center">
        <form action="">
            <div class="w-96 ring ring-1 ring-gray-300 rounded-lg p-4">
                <h2 class="text-2xl font-semibold mb-3">Login Form</h2>
                <div class="input-field flex flex-col gap-1 mb-2">
                    <label for="username" class="font-medium">Username</label>
                    <input type="text" id="username"
                        class="rounded-md ring-1 ring-inset ring-gray-300 w-full px-3 py-1.5 outline-none focus:ring-2 focus:ring-inset focus:ring-sky-500 transition"
                        placeholder="Input username...">
                </div>
                <div class="input-field flex flex-col gap-1 mb-7">
                    <label for="password" class="font-medium">Password</label>
                    <input type="password" id="password"
                        class="rounded-md ring-1 ring-inset ring-gray-300 w-full px-3 py-1.5 outline-none focus:ring-2 focus:ring-inset focus:ring-sky-500 transition"
                        placeholder="Input password...">
                </div>
                <button
                    class="bg-sky-400 rounded-md w-full py-2 text-white font-semibold hover:bg-sky-600 transition">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>