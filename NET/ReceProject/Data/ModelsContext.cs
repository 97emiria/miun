using Microsoft.EntityFrameworkCore;
using ReceProject.Models;

namespace ReceProject.Data;

    public class ModelsContext : DbContext
    {
        public ModelsContext(DbContextOptions<ModelsContext> options) : base(options)
        {

        }

        public DbSet<News> News { get; set; }
        public DbSet<Rent> Rents { get; set; }
        public DbSet<Room> Rooms { get; set; }

    }

