using Microsoft.EntityFrameworkCore;
using CatApi.Models;


namespace CatApi.Data 
{
    public class CatContext : DbContext 
    {
        public CatContext(DbContextOptions options) : base(options) { 

        }

        public DbSet<Cat> Cats {get; set;}

    }
}

