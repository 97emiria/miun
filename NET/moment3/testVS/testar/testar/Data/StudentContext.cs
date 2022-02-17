﻿using Microsoft.EntityFrameworkCore;
using testar.Models;

namespace testar.Data
{
    public class StudentContext : DbContext
    {

        public StudentContext(DbContextOptions<StudentContext> options) : base(options)
        {

        }

        public DbSet<Student> Students { get; set; }
    }
}
