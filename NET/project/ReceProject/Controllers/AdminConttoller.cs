using System.Diagnostics;
using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;
using ReceProject.Data;
using ReceProject.Models;
using Microsoft.AspNetCore.Mvc.Rendering;

namespace ReceProject.Controllers;

public class AdminController : Controller
{
    private readonly ILogger<AdminController> _logger;
    private readonly ApplicationDbContext _Applicationcontext;
    private readonly ModelsContext _Modelscontext;

    public AdminController(ILogger<AdminController> logger, ApplicationDbContext Applicationcontext, ModelsContext Modelscontext)
    {
        _logger = logger;
        _Applicationcontext = Applicationcontext;
        _Modelscontext = Modelscontext;

    }

    [Authorize]
    public IActionResult Index()
    {
        //Get numbers to compare in index
        ViewData["AllRooms"] = _Modelscontext.Rooms.ToList().Count().ToString();
        ViewData["AllRents"] = _Modelscontext.Rents.ToList().Count().ToString();

        //Get the lists
        var AllRents = _Modelscontext.Rents.ToList();

        //Creat a new list with all rooms
        int EmployeesRents = 0;
        foreach (var Rent in AllRents.ToList())
        {
            //Compare if room exist in database
            if (Rent.RentedByEmployee == User.Identity.Name)
            {
                EmployeesRents++;
            }
        }
        ViewData["EmployeesRents"] = EmployeesRents;


        var AllNews = _Applicationcontext.Users.ToList();
        return View(AllNews);
    }
}

