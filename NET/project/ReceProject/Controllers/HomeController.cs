﻿using System.Diagnostics;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.Rendering;
using ReceProject.Models;
using ReceProject.Data;

using Microsoft.EntityFrameworkCore;

namespace ReceProject.Controllers;

public class HomeController : Controller
{
    private readonly ILogger<HomeController> _logger;
    private readonly ModelsContext _context;

    public HomeController(ILogger<HomeController> logger, ModelsContext context)
    {
        _logger = logger;
        _context = context;

    }
    public IActionResult Index()
    {

        //Get news list
        //ViewData["NewsID"] = new SelectList(_context.News.ToList(), "NewsID", "Header");
        ViewData["NewsID"] = new SelectList(_context.News, "NewsID", "Header", "Text");

        var albums = from m in _context.News select m;
        ViewData["NewsID"] = albums;

        var AllNews =  _context.News.ToList();


        return View(AllNews);
    }

    
    [HttpGet("/Kontakt")]
    public IActionResult Contact()
    {
        return View();
    }

    [HttpGet("/Kontorsrum")]
    public IActionResult Room()
    {

        //ViewData["RoomId"] = new SelectList(_context.Rooms, "Id", "Name");
        var AllRooms =  _context.Rooms.ToList();

        return View(AllRooms);
    }

    
       


    [ResponseCache(Duration = 0, Location = ResponseCacheLocation.None, NoStore = true)]
    public IActionResult Error()
    {
        return View(new ErrorViewModel { RequestId = Activity.Current?.Id ?? HttpContext.TraceIdentifier });
    }
}