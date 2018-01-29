class Mcc < ApplicationRecord
  validates :nomPromo, presence: true
  validates :codeApogee, presence: true
  validates :semestre, presence: true
  validates :coeff, presence: true
  validates :urlNotes, presence: true
end
