#nullable disable
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.Rendering;
using Microsoft.EntityFrameworkCore;
using ReceProject.Data;
using ReceProject.Models;
using System.Drawing;
using LazZiya.ImageResize;
using System;
using System.Drawing;
using System.IO;

namespace ReceProject.Controllers_Admin
{
    public class RoomController : Controller
    {
        private readonly ModelsContext _context;
        private readonly IWebHostEnvironment _hostEnvironment;

        public RoomController(ModelsContext context, IWebHostEnvironment hostEnvironment)
        {
            _context = context;
            _hostEnvironment = hostEnvironment;
        }

        // GET: Room
        [Authorize]
        [HttpGet("/Rum")]
        public async Task<IActionResult> Index(string searchString)
        {
            //Search
            var searchResult = from m in _context.Rooms select m;
            if (!String.IsNullOrEmpty(searchString))
            {
                searchResult = searchResult.Where(s => s.Name!.Contains(searchString));

                //Return search result
                return View(await searchResult.ToListAsync());

            }


            return View(await _context.Rooms.ToListAsync());
        }

        // GET: Room/Details/5
        //[HttpGet("/Rum/Detaljer")]
        public async Task<IActionResult> Details(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var room = await _context.Rooms
                .FirstOrDefaultAsync(m => m.Id == id);
            if (room == null)
            {
                return NotFound();
            }

            return View(room);
        }

        // GET: Room/Create
        [Authorize]
        public IActionResult Create()
        {
            return View();
        }

        // POST: Room/Create
        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Create([Bind("Id,Name,Price,Description,ImageFile,LastUpdated")] Room room)
        {
            if (ModelState.IsValid)
            {

                //Upload image 
                if (room.ImageFile != null)
                {
                    //Strings
                    string wwwRootPath = _hostEnvironment.WebRootPath;                              //String to wwwroot folder / file path

                    //Add file to model / Save filename to database
                    string fileName = Path.GetFileNameWithoutExtension(room.ImageFile.FileName);    //File name without 
                    string extension = Path.GetExtension(room.ImageFile.FileName);                  //Filh??ndelse / datatyp
                    fileName = fileName + DateTime.Now.ToString("yyyyMMddssff") + extension;

                    //Save new filename to database
                    room.ImageName = fileName;

                    //Output path
                    string path = Path.Combine(wwwRootPath + "/uploadsRooms/" + fileName);

                    //Move to folder 
                    using (var fileStream = new FileStream(path, FileMode.Create))
                    {
                        await room.ImageFile.CopyToAsync(fileStream);
                    }


                    //Creat resizes images
                    ResizeImage(room.ImageName);
                }


                try
                {
                    //Things dont update 
                    //Publish

                    _context.Update(room);
                    await _context.SaveChangesAsync();
                }
                catch (DbUpdateConcurrencyException)
                {
                    if (!RoomExists(room.Id))
                    {
                        return NotFound();
                    }
                    else
                    {
                        throw;
                    }
                }
                return RedirectToAction(nameof(Index));
            }

            return View(room);
        }


        //Resize Images
        private void ResizeImage(string fileName)
        {
            string wwwRootPath = _hostEnvironment.WebRootPath;                  //String to wwwroot folder / file path

            //Thumbnail
            using (var img = Image.FromFile(Path.Combine(wwwRootPath + "/uploadsRooms/" + fileName)))
            {
                img.Scale(400, 300).SaveAs(Path.Combine(wwwRootPath + "/uploadsRooms/small_" + fileName));
                img.Scale(800, 600).SaveAs(Path.Combine(wwwRootPath + "/uploadsRooms/big_" + fileName));
            }

            System.IO.File.Delete(wwwRootPath + "/uploadsRooms/" + fileName);

        }

        private void ResizeImageTwo(string fileName)
        {
            string wwwRootPath = _hostEnvironment.WebRootPath;                  //String to wwwroot folder / file path

            //Thumbnail
            using (var img = Image.FromFile(Path.Combine(wwwRootPath + "/uploadsRooms/" + fileName)))
            {
                img.Scale(400, 300).SaveAs(Path.Combine(wwwRootPath + "/uploadsRooms/small_" + fileName + "____new"));
                img.Scale(800, 600).SaveAs(Path.Combine(wwwRootPath + "/uploadsRooms/big_" + fileName + "____new"));
            }

            System.IO.File.Delete(wwwRootPath + "/uploadsRooms/" + fileName);

        }

        // GET: Room/Edit/5
        [Authorize]
        public async Task<IActionResult> Edit(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var room = await _context.Rooms.FindAsync(id);
            if (room == null)
            {
                return NotFound();
            }
            return View(room);
        }

        // POST: Room/Edit/5
        // To protect from overposting attacks, enable the specific properties you want to bind to.
        // For more details, see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Edit(int id, [Bind("Id,Name,Price,Description,ImageName, ImageFile,LastUpdated")] Room room)
        {
            if (id != room.Id)
            {
                return NotFound();
            }

            //Strings
            string wwwRootPath = _hostEnvironment.WebRootPath;                              //String to wwwroot folder / file path

            if (ModelState.IsValid)
            {

                //Upload image 
                if (room.ImageFile != null)
                {
                    //Remove old image
                    System.IO.File.Delete(wwwRootPath + "/uploadsRooms/big_" + room.ImageName);
                    System.IO.File.Delete(wwwRootPath + "/uploadsRooms/small_" + room.ImageName);

                    //Add file to model / Save filename to database
                    string fileName = Path.GetFileNameWithoutExtension(room.ImageFile.FileName);    //File name without 
                    string extension = Path.GetExtension(room.ImageFile.FileName);                  //Filh??ndelse / datatyp
                    fileName = fileName + DateTime.Now.ToString("yyyyMMddssff") + extension;

                    room.ImageName = fileName;

                    //Output path
                    string path = Path.Combine(wwwRootPath + "/uploadsRooms/" + fileName);

                    //Move to folder 
                    using (var fileStream = new FileStream(path, FileMode.Create))
                    {
                        await room.ImageFile.CopyToAsync(fileStream);
                    }


                    //Creat resizes images
                    ResizeImage(room.ImageName);

                }


                try
                {
                    _context.Update(room);
                    await _context.SaveChangesAsync();
                }
                catch (DbUpdateConcurrencyException)
                {
                    if (!RoomExists(room.Id))
                    {
                        return NotFound();
                    }
                    else
                    {
                        throw;
                    }
                }
                return RedirectToAction(nameof(Index));
            }
            return View(room);
        }

        // GET: Room/Delete/5
        [Authorize]
        //[HttpGet("/Rum/Ta-bort")]
        public async Task<IActionResult> Delete(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var room = await _context.Rooms
                .FirstOrDefaultAsync(m => m.Id == id);
            if (room == null)
            {
                return NotFound();
            }

            return View(room);
        }

        // POST: Room/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> DeleteConfirmed(int id)
        {
            var room = await _context.Rooms.FindAsync(id);

            //Remove old image
            string wwwRootPath = _hostEnvironment.WebRootPath;                              //String to wwwroot folder / file path
            System.IO.File.Delete(wwwRootPath + "/uploadsRooms/big_" + room.ImageName);
            System.IO.File.Delete(wwwRootPath + "/uploadsRooms/small_" + room.ImageName);

            _context.Rooms.Remove(room);
            await _context.SaveChangesAsync();
            return RedirectToAction(nameof(Index));
        }

        private bool RoomExists(int id)
        {
            return _context.Rooms.Any(e => e.Id == id);
        }
    }
}
