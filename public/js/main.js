// Recherche de cours par mots-clés
let allSearchCourse = [];
const searchKey = async () => {
    document.querySelector("#response").innerHTML = "";
    let keyword = document.querySelector('#keyword').value.toLowerCase();
    if (keyword.length > 3) {
        const req = await fecth(`http://localhost/MyProjects/Brief_11_Youdemy/app/views/pages/courses/index.php?keyword=${keyword}`);
        const json = await req.json();
        console.log(json);
        
        // if (json.length > 0) {
        //     json.forEach((courses) => {
        //         document.querySelector("#response").innerHtml += 
        //        `<div class="cursor-pointer grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 curser-pointer ">
        //             <div class="duration-500 hover:scale-105  container mx-auto p-6">
        //                 <div class="bg-white shadow-md rounded-md overflow-hidden">
        //                     <img src="${courses.image}>" alt="Course Image" class="w-full h-48 object-cover">
        //                     <div class="p-4">
        //                         <h2 class="text-xl font-semibold text-gray-800">${courses.title}</h2>
        //                         <p class="text-gray-600 mt-2">${courses.description}</p>
        //                         <div class="mt-4 flex justify-between items-center">
        //                             <span class="text-sm font-bold text-gray-500">Price : ${courses.Price} $</span>
        //                             <a href="#" class="text-blue-500 hover:underline">View Details</a>
        //                          </div>
        //                     </div>
        //                  </div>
        //               </div>
        //         </div>` 
        //     })
        // }
    }
} 

// let allplayers = [];
// const All_players = "../../../DataBase/players.json";
// fetch(All_players)
//   .then((response) => response.json())
//   .then((data) => {
//     allplayers = data.players;
//     displayPlayers(allplayers);
//   })
//   .catch((error) => console.error("Error loading JSON data:", error));
// // Function display players
// function displayPlayers(players) {
//   const playersContainer = document.getElementById("all_players");
//   playersContainer.innerHTML = "";

//   players.forEach((player) => {
//     const playersDiv = document.createElement("div");
//     playersDiv.classList.add("player");

//     playersDiv.innerHTML = `
//                         <div class="card-player relative w-fit text-black bg-slate-200 rounded-3xl ">
//                         <img class="ml-4" src="/src/assets/images/addPlayer1.png" alt="img-Card">
//                         <div class="w-fit absolute top-14 left-16 text-center rounded-full" >
//                         <img class="w-28 rounded-full" src="${player.photo}" alt="">
//                         <h4 class="name  text-white">${player.name}</h4>
//                         <img class="inline" src="${player.flag}" alt="flag"><img class="w-10 inline" src="${player.logo}" alt="logo-Team">
//                         </div>
//                         <span class="absolute font-bold top-[2px] left-3 p-2 border border-black rounded-full">${player.position}</span>
//                         <div class="text-sm flex text-center gap-2 ml-2">
//                         <div class="w-[25px]">RAT ${player.rating}</div>
//                         <div class="w-[25px]">PAC ${player.pace}</div>
//                         <div class="w-[25px]">SHO ${player.shooting}</div>
//                         <div class="w-[25px]">PAS ${player.passing}</div>
//                         <div class="w-[25px]">DRI ${player.dribbling}</div>
//                         <div class="w-[25px]">DEF ${player.defending}</div>
//                         <div class="w-[25px]">PHY ${player.physical}</div><br>
//                         </div> `;

//     playersContainer.appendChild(playersDiv);
//   });
// }

// filtrage by searsh Bar
// function filterPlayers() {
//   const searchTerm = document.getElementById("searchBar").value.toLowerCase();
//   const filteredplayers = allplayers.filter(
//     (players) =>
//       players.name.toLowerCase().includes(searchTerm) ||
//       (Array.isArray(players.position)
//         ? players.position.some((pos) => pos.toLowerCase().includes(searchTerm))
//         : players.position.toLowerCase().includes(searchTerm))
//   );
// }


 
 // Dropdown toggle
 document.getElementById('dropdownButton').addEventListener('click', () => {
    const dropdownMenu = document.getElementById('dropdownMenu');
    dropdownMenu.classList.toggle('hidden');
});

// Modal open/close
document.querySelectorAll('[data-modal-target]').forEach(button => {
    button.addEventListener('click', () => {
        const modal = document.querySelector(button.getAttribute('data-modal-target'));
        modal.classList.remove('hidden');
    });
});

document.querySelectorAll('[data-modal-close]').forEach(button => {
    button.addEventListener('click', () => {
        button.closest('.fixed').classList.add('hidden');
    });
});