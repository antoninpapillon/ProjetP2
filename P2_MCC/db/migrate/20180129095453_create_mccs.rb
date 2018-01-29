class CreateMccs < ActiveRecord::Migration[5.1]
  def change
    create_table :mccs do |t|
      t.string :nomPromo
      t.string :codeApogee
      t.string :semestre
      t.integer :coeff
      t.string :urlNotes

      t.timestamps
    end
  end
end
