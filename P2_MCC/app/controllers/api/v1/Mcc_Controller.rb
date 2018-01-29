module Api
  module V1
    class MccController < ApplicationController
      def index
        mccs = Mcc.order('codeApogee ASC')
        render json: mccs
      end

      def show
        mcc = Mcc.find(params[:id])
        render json: mcc
      end

      def create
        @mcc = Mcc.create(mcc_params)
        render json: @mcc
      end

      def update
        @mcc = Mcc.find(params[:id])
        @mcc.update_attributes(mcc_params)
        render json: @mcc
      end

      private

      def mcc_params
        params.require(:mcc).permit(:nomPromo, :codeApogee, :semestre, :coeff, :urlNotes)
      end

    end
  end
end