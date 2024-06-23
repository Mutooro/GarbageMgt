<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints Report</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" type="text/css" href="../../node_modules/datatables.net-dt/css/jquery.dataTables.min.css">

</head>

<body class="bg-gray-200">
    <div class="flex">
        <?php include('dashlayout.php') ?>
        <?php
        $asqry = "SELECT * FROM assigned_bin a RIGHT JOIN complaints c ON a.complain_id = c.complain_id WHERE c.complain_status <> 'new'";
        $res = mysqli_query($con, $asqry);
        ?>
        <div class="h-full w-full p-5 ml-14 md:ml-64">
            <div class="w-full p-5 ">
                <h2 class="text-3xl border-b-2 border-blue-600">Complain Histories</h2>
            </div>
            <div class="container max-w-full px-4 mx-auto sm:px-8">
                <div class="py-5">
                    <div class="px-4 py-4 -mx-4 overflow-x-auto sm:-mx-8 sm:px-8">
                        <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
                            <table class="min-w-full" id="myTable">
                                <thead>
                                    <tr class="bg-green-100 ">
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            SN
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Report Date
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Bin Report Picture
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Bin ID
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Complain Message
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Details
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $d = 1;
                                    while ($data = mysqli_fetch_assoc($res)) {
                                    ?>
                                        <tr>
                                            <input id="aidpop" type="hidden" value="<?php echo $data['assign_id']; ?>">
                                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    <?php echo $d; ?>
                                                </p>
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    <?php echo $data['timestamp']; ?>
                                                </p>
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                <p class="text-gray-900 whitespace-no-wrap w-full h-24 pb-[50%] relative">
                                                    <img src="../user/<?php echo $data['bin_picture']; ?>" class="absolute inset-0 w-full h-full object-cover" alt="">
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    <?php echo $data['bin_id']; ?>
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    <?php echo $data['description']; ?>

                                                </p>
                                            </td>
                                            <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    <?php echo $data['complain_status']; ?>
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 text-sm border-b border-gray-200">
                                                <p class="flex text-gray-900 whitespace-no-wrap">


                                                    <a href="detailscomplain.php?cid=<?php echo $data['complain_id'] ?>" class="bg-green-400 rounded-md hover:bg-green-500 ease text-white font-bold py-3 px-6">View</a>
                                                    <a onclick="showDelete(<?php echo $d['complain_id'] ?>);" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded cursor-pointer">Delete</a>
                                                </p>
                                            </td>
                                        </tr>
                                    <?php $d++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="deletebox" class="hidden fixed inset-0 bg-opacity-40 backdrop-blur-sm">
        <div class="flex h-full justify-center items-center">
            <div class="flex flex-col p-10 rounded-lg shadow bg-white">
                <div class="text-center">
                    <h2 class="font-semibold text-gray-800">Are you sure want to delete?</h2>
                </div>
                <div class="flex items-center mt-6">
                    <button onclick="hideDelete()" class="flex-1 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-medium rounded-md">
                        Cancel
                    </button>
                    <a href="" id="agree" class="flex-1 px-4 py-2 ml-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-md text-center">
                        Agree
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDelete(x) {
            document.getElementById("deletebox").style.display = "block";
            document.getElementById('agree').href = "deletebin.php?did=" + x;

        }

        function hideDelete() {
            document.getElementById("deletebox").style.display = "none";
        }
    </script>

    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="../../node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>