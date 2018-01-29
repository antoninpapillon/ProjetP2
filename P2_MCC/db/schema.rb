# This file is auto-generated from the current state of the database. Instead
# of editing this file, please use the migrations feature of Active Record to
# incrementally modify your database, and then regenerate this schema definition.
#
# Note that this schema.rb definition is the authoritative source for your
# database schema. If you need to create the application database on another
# system, you should be using db:schema:load, not running all the migrations
# from scratch. The latter is a flawed and unsustainable approach (the more migrations
# you'll amass, the slower it'll run and the greater likelihood for issues).
#
# It's strongly recommended that you check this file into your version control system.

ActiveRecord::Schema.define(version: 20180129095453) do

  create_table "epreuve", id: :integer, force: :cascade, options: "ENGINE=InnoDB DEFAULT CHARSET=latin1" do |t|
    t.string "code_apogee", limit: 10, null: false
    t.decimal "coeff", precision: 11, scale: 2, null: false
    t.string "type", limit: 100
    t.boolean "optionnel", null: false
    t.string "intitule", null: false
    t.string "code_apogee_module", limit: 10, null: false
    t.string "enseignant", limit: 80, null: false
  end

  create_table "etudiant", primary_key: "identifiant", id: :string, limit: 10, force: :cascade, options: "ENGINE=InnoDB DEFAULT CHARSET=latin1" do |t|
    t.string "nom", limit: 50, null: false
    t.string "prenom", limit: 50, null: false
    t.string "code_apogee", limit: 8, null: false
    t.string "promotion", limit: 10, null: false
    t.string "groupe", limit: 10
    t.string "options", limit: 50
    t.string "lv2", limit: 30
    t.string "alternant", limit: 3
  end

  create_table "mccs", force: :cascade, options: "ENGINE=InnoDB DEFAULT CHARSET=utf8" do |t|
    t.string "nomPromo"
    t.string "codeApogee"
    t.string "semestre"
    t.integer "coeff"
    t.string "urlNotes"
    t.datetime "created_at", null: false
    t.datetime "updated_at", null: false
  end

  create_table "module", id: :integer, force: :cascade, options: "ENGINE=InnoDB DEFAULT CHARSET=latin1" do |t|
    t.string "code_apogee", limit: 10, null: false
    t.integer "coeff", null: false
    t.string "colonne_recap", limit: 5
    t.boolean "optionnel", null: false
    t.string "intitule", null: false
    t.string "code_apogee_UE", limit: 10, null: false
  end

  create_table "notes", id: :integer, force: :cascade, options: "ENGINE=InnoDB DEFAULT CHARSET=latin1" do |t|
    t.string "identifiant_etu", limit: 10, null: false
    t.string "indicateur", limit: 10, null: false
    t.decimal "note", precision: 10, scale: 2, null: false
  end

  create_table "sous_module", id: :integer, force: :cascade, options: "ENGINE=InnoDB DEFAULT CHARSET=latin1" do |t|
    t.string "code_apogee", limit: 10, null: false
    t.integer "coeff", null: false
    t.boolean "optionnel", null: false
    t.string "intitule", null: false
    t.string "code_apogee_module", limit: 10, null: false
  end

  create_table "sous_module_epreuve", id: :integer, force: :cascade, options: "ENGINE=InnoDB DEFAULT CHARSET=latin1" do |t|
    t.string "code_apogee", limit: 10, null: false
    t.decimal "coeff", precision: 11, scale: 2, null: false
    t.string "type", limit: 100
    t.boolean "optionnel", null: false
    t.string "intitule", null: false
    t.string "code_apogee_sous_module", limit: 10, null: false
    t.string "enseignant", limit: 80, null: false
  end

  create_table "ue", id: :integer, force: :cascade, options: "ENGINE=InnoDB DEFAULT CHARSET=latin1" do |t|
    t.string "code_apogee", limit: 10, null: false
    t.integer "coeff", null: false
    t.string "colonne_recap", limit: 5, null: false
    t.boolean "optionnel", null: false
    t.string "intitule", null: false
  end

end
