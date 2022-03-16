using System.Diagnostics;
using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;
using ReceProject.Data;
using ReceProject.Models;

namespace ReceProject.Controllers;

public class AdminController : Controller
{
    private readonly ILogger<AdminController> _logger;
    private readonly ApplicationDbContext _context;

    public AdminController(ILogger<AdminController> logger, ApplicationDbContext context)
    {
        _logger = logger;
        _context = context;
    }

    [Authorize]
    public IActionResult Index()
    {
        var AllNews =  _context.Users.ToList();
        return View(AllNews);
    }
}
